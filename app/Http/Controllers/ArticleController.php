<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::all();
        return view('dashboard.admin.article.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('dashboard.admin.article.create', compact('categories'));
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
        ]);

        if ($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = date('ymdHis') . $image->getClientOriginalName();
            $image->storeAs('image-article', $image_name, 'public');
        }

        Article::create(
            [
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'category_id' => $request->input('category_id'),
                'image' => $image_name,
                'publish' => null,
            ]
        );

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
        return view('dashboard.admin.article.edit', compact('article', 'categories'));
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
            'image' => 'required|mimes:png,jpg,jpeg|max:2048',
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
        } else {
            $image_name = $article->image;
        }

        $article->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'category_id' => $request->input('category_id'),
            'image' => $image_name,
            'publish' => $request->input('publish'),
        ]);

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

        // dd($article);

        $article->delete();

        Alert::success('success', 'Artikel Berhasil di Hapus');
        return redirect()->route('article_index');
    }
}
