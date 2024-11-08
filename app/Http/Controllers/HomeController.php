<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
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
        // $articles = Article::all();
        // Mengambil 6 artikel terbaru
        $articles = Article::latest()->take(6)->get();
        $gameArticles = Article::whereHas('Category', function ($query) {
            $query->where('name', 'game');
        })->get(); //ganti menjadi latest()->take()->Get(); untuk mengambil berapa data dan terbaru
        $aiArticles = Article::whereHas('Category', function ($query) {
            $query->where('name', 'ai');
        })->get();
        return view('web.home', compact('articles', 'gameArticles', 'aiArticles'));
    }

    public function show($category = null)
    {
        $articles = Article::when($category, function ($query, $category) {
            $query->whereHas('Category', function ($q) use ($category) {
                $q->where('name', $category);
            });
        })->paginate(5);

        return view('web.showall', compact('articles', 'category'));
    }

    public function detail($slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();
        $article->increment('views');
        $category = Category::all();
        $otherArticle = Article::latest()->take(3)->get();
        return view('web.detail', compact('article', 'category', 'otherArticle'));
    }
}
