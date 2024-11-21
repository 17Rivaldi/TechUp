<?php

namespace App\Providers;

use App\Models\Article;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Spatie\Tags\Tag;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
        View::composer(['web.home', 'web.showall', 'web.detail', 'web.showsearch'], function ($view) {
            $popularArticles = Article::orderBy('views', 'desc')->take(5)->get();
            $tags = Tag::all();
            $users = auth()->user();
            $view->with(compact('popularArticles', 'tags', 'users'));
        });
    }
}
