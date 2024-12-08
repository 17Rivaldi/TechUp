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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $articles = Article::published()->latest()->take(6)->get();
        $gameArticles = Article::published()->whereHas('Category', function ($query) {
            $query->where('name', 'game');
        })->latest()->take(4)->get();
        $otherArticles = Article::published()
            ->whereDoesntHave('Category', function ($query) {
                $query->whereIn('name', ['game']);
            })
            ->latest()
            ->get()
            ->groupBy('category.name');
        return view('web.home', compact('articles', 'gameArticles', 'otherArticles'));
    }

    public function show(Request $request, Category $category = null)
    {
        $articles = Article::published()->when($category, function ($query, $category) {
            $query->whereHas('Category', function ($q) use ($category) {
                $q->where('slug', $category->slug); // Cocokkan berdasarkan ID kategori
            });
        })->latest()->paginate(10);

        $articles->getCollection()->transform(function ($article) {
            $article->description = Str::limit($article->description, 200, preserveWords: true);
            return $article;
        });

        return view('web.showall', compact('articles', 'category'));
    }

    public function showTag($tagSlug)
    {
        $tag = Tag::where('slug->id', $tagSlug)->firstOrFail();
        $articles = Article::published()->withAnyTags([$tag->name])->latest()->paginate(10);

        $articles->getCollection()->transform(function ($article) {
            $article->description = Str::limit($article->description, 200, preserveWords: true);
            return $article;
        });

        return view('web.showall', compact('articles', 'tag'));
    }

    public function showRecommended()
    {
        $articles = Article::published()->where('recommended', true)->latest()->paginate(10);

        $articles->getCollection()->transform(function ($article) {
            $article->description = Str::limit($article->description, 200, preserveWords: true);
            return $article;
        });

        return view('web.showall', compact('articles'));
    }

    public function showPopular()
    {
        $articles = Article::published()->orderBy('views', 'desc')->paginate(10);

        $articles->getCollection()->transform(function ($article) {
            $article->description = Str::limit($article->description, 200, preserveWords: true);
            return $article;
        });

        return view('web.showall', compact('articles'));
    }

    public function detail($slug)
    {
        $article = Article::published()->where('slug', $slug)->firstOrFail();
        $article->increment('views');
        $category = Category::all();
        $otherArticle = Article::published()->latest()->take(6)->get();
        return view('web.detail', compact('article', 'category', 'otherArticle'));
    }

    public function search(Request $request)
    {
        $query = $request->input('search');

        // Jika query ada, lakukan pencarian pada artikel
        $articles = Article::published()->when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder->where('title', 'like', '%' . $query . '%')
                ->orWhere('description', 'like', '%' . $query . '%');
        })->latest()->paginate(10);

        $articles->getCollection()->transform(function ($article) {
            $article->description = Str::limit($article->description, 200, preserveWords: true);
            return $article;
        });

        return view('web.showall', compact('articles', 'query'));
    }
}
