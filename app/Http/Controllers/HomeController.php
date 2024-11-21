<?php

namespace App\Http\Controllers;

use Spatie\Tags\Tag;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Mengambil 6 artikel terbaru
        $articles = Article::latest()->take(6)->get();
        // Menampilkan Artikel hanya yang sudah di publish
        // $articles = Article::whereNotNull('publish')->latest()->take(6)->get();
        $gameArticles = Article::whereHas('Category', function ($query) {
            $query->where('name', 'game');
        })->latest()->take(6)->get();
        $otherArticles = Article::whereDoesntHave('Category', function ($query) {
            $query->whereIn('name', ['game']);
        })->latest()->take(6)->get()->groupBy('category.name');
        return view('web.home', compact('articles', 'gameArticles', 'otherArticles'));
    }

    public function show(Request $request, $category = null)
    {
        if ($category && !Category::where('name', $category)->exists()) {
            abort(404);
        }

        $articles = Article::when($category, function ($query, $category) {
            $query->whereHas('Category', function ($q) use ($category) {
                $q->where('name', $category);
            });
        })->latest()->paginate(5);

        $articles->getCollection()->transform(function ($article) {
            $article->description = Str::limit($article->description, 200, preserveWords: true);
            return $article;
        });

        return view('web.showall', compact('articles', 'category'));
    }

    public function showTag($tagSlug)
    {
        $tag = Tag::where('slug->id', $tagSlug)->firstOrFail();
        $articles = Article::withAnyTags([$tag->name])->latest()->paginate(5);

        $articles->getCollection()->transform(function ($article) {
            $article->description = Str::limit($article->description, 200, preserveWords: true);
            return $article;
        });

        return view('web.showall', compact('articles', 'tag'));
    }

    public function detail($slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();
        $article->increment('views');
        $category = Category::all();
        $otherArticle = Article::latest()->take(3)->get();
        return view('web.detail', compact('article', 'category', 'otherArticle'));
    }

    public function search(Request $request)
    {
        // Ambil query pencarian dari input form
        $query = $request->input('search');

        // Jika query ada, lakukan pencarian pada artikel
        $articles = Article::when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder->where('title', 'like', '%' . $query . '%')
                ->orWhere('description', 'like', '%' . $query . '%');
        })->latest()->paginate(5);

        // Transformasi deskripsi artikel untuk mempersingkat
        $articles->getCollection()->transform(function ($article) {
            $article->description = Str::limit($article->description, 200, preserveWords: true);
            return $article;
        });

        // Kembalikan view dengan data artikel
        return view('web.showall', compact('articles', 'query'));
    }
}
