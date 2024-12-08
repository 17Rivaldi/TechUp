<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Drivers\Gd\Driver;
use Spatie\Tags\Tag;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->hasRole('admin')) {
            $articles = Article::all();
        } else {
            $articles = Article::where('user_id', auth()->id())->get();
        }

        return view('dashboard.admin.article.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('dashboard.admin.article.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg|max:2048',
            'tags' => 'nullable|array',
            'tags.*' => 'string',
        ]);

        if ($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = date('ymdHis') . '_' . $image->getClientOriginalName();
            $image->storeAs('image-article', $image_name, 'public');

            $imgManager = new ImageManager(new Driver());
            $thumbImage = $imgManager->read(storage_path('app/public/image-article/' . $image_name));
            $thumbImage->resize(1280, 720);
            $thumbImage->text('TechUp', 20, 20, function ($font) {
                $font->size(500);
                $font->color('#d0d0d0');
            });
            $thumbImage->save(storage_path('app/public/image-article/' . $image_name));
        }

        $article = Article::create(
            [
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'category_id' => $request->input('category_id'),
                'image' => $image_name,
                'publish' => null,
                'user_id' => auth()->user()->id,
            ]
        );

        // Add Tags
        if ($request->has('tags')) {
            $tags = array_map('strtolower', $request->input('tags'));
            $article->attachTags($tags);
        }

        Alert::success('success', 'Article Berhasil ditambah');
        return redirect()->route('article_index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $article = Article::findOrFail($id);
        $categories = Category::all();
        $tags = Tag::all();
        return view('dashboard.admin.article.edit', compact('article', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'image' => 'nullable|mimes:png,jpg,jpeg|max:2048',
            'tags' => 'nullable|array',
            'tags.*' => 'string',
        ]);

        if ($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $article = Article::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($article->image && Storage::disk('public')->exists('image-article/' . $article->image)) {
                Storage::disk('public')->delete('image-article/' . $article->image);
            }

            $image = $request->file('image');
            $image_name = date('ymdHis') . '_' . $image->getClientOriginalName();
            $image->storeAs('image-article', $image_name, 'public');

            $imgManager = new ImageManager(new Driver());
            $thumbImage = $imgManager->read(storage_path('app/public/image-article/' . $image_name));
            $thumbImage->resize(1280, 720);
            $thumbImage->text('TechUp', 20, 20, function ($font) {
                $font->size(500);
                $font->color('#d0d0d0');
            });
            $thumbImage->save(storage_path('app/public/image-article/' . $image_name));
        }

        $article->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'category_id' => $request->input('category_id'),
            'image' => isset($image_name) ? $image_name : $article->image,
        ]);

        // Add Update tags
        if ($request->has('tags')) {
            $tags = array_map('strtolower', $request->input('tags'));
            $article->syncTags($tags);
        }

        Alert::success('success', 'Article Berhasil diubah');
        return redirect()->route('article_index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $article = Article::findOrFail($id);

        if (!$article) {
            Alert::error('error', 'Category tidak ditemukan.');
            return redirect()->route('article_index');
        }

        if ($article->image) {
            Storage::disk('public')->delete('image-article/' . $article->image);
        }

        $article->delete();

        Alert::success('success', 'Artikel Berhasil di Hapus');
        return redirect()->route('article_index');
    }

    public function publish($id)
    {
        $article = Article::findOrFail($id);

        if ($article->publish) {
            $article->publish = null;
            $message = 'Artikel berhasil di-unpublish.';
        } else {
            $article->publish = now();
            $message = 'Artikel berhasil dipublish.';
        }

        $article->save();

        Alert::success('success', $message);
        return redirect()->back();
    }

    public function uploadImage(Request $request)
    {
        try {
            // Debug: cek apakah request memiliki file
            if (!$request->hasFile('upload')) {
                return response()->json([
                    'uploaded' => false,
                    'error' => [
                        'message' => 'No file was uploaded.',
                    ],
                ], 400);
            }

            $file = $request->file('upload');

            // Debug: cek detail file
            // \Log::info('File uploaded: ' . $file->getClientOriginalName());

            // Validasi gambar
            $validated = $request->validate([
                'upload' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
            ]);

            // Simpan gambar
            $fileName = date('ymdHis') . '_' . preg_replace('/[^a-zA-Z0-9\-_\.]/', '_', $file->getClientOriginalName());
            $path = $file->storeAs('image-ckeditor', $fileName, 'public');

            return response()->json([
                'uploaded' => true,
                'url' => asset('storage/' . $path),
            ]);
        } catch (\Exception $e) {
            // Debug: log error
            // \Log::error('Upload failed: ' . $e->getMessage());
            return response()->json([
                'uploaded' => false,
                'error' => [
                    'message' => 'An error occurred during upload: ' . $e->getMessage(),
                ],
            ], 500);
        }
    }

    public function recommended($id)
    {
        $article = Article::findOrFail($id);
        // Status Recommended Boolean
        $article->recommended = !$article->recommended;
        $article->save();

        Alert::success('success', 'Artikel berhasil direkomendasikan.');
        return redirect()->back();
    }
}
