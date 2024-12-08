<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $totalUser = User::count();
        $totalCategory = Category::count();
        $totalRole = Role::count();

        if (auth()->user()->hasRole('admin')) {
            $totalArticle = Article::count();
            $totalArticlePerMonth = Article::whereMonth('created_at', now()->month)->count();
            $totalArticlePerDay = Article::whereDate('created_at', today())->count();
        } else {
            $totalArticle = Article::where('user_id', auth()->id())->count();
            $totalArticlePerMonth = Article::where('user_id', auth()->id())
                ->whereMonth('created_at', now()->month)
                ->count();
            $totalArticlePerDay = Article::where('user_id', auth()->id())
                ->whereDate('created_at', today())
                ->count();
        }

        return view('dashboard.admin.home', compact('totalUser', 'totalArticle', 'totalCategory', 'totalRole', 'totalArticlePerMonth', 'totalArticlePerDay'));
    }
}
