<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;

Auth::routes(['verify' => true]);

Route::middleware(['auth', 'verified', 'role:admin|writer|editor'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/user', [UserController::class, 'index'])->name('user_index');
    Route::get('/user/create', [UserController::class, 'create'])->name('user_create');
    Route::post('/user/save', [UserController::class, 'store'])->name('user_store');
    Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user_edit');
    Route::put('/user/{id}', [UserController::class, 'update'])->name('user_update');
    Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user_destroy');

    // Category
    Route::get('/category', [CategoryController::class, 'index'])->name('category_index');
    Route::get('/category/create', [CategoryController::class, 'create'])->name('category_create');
    Route::post('/category/save', [CategoryController::class, 'store'])->name('category_store');
    Route::get('/category/{id}/edit', [CategoryController::class, 'edit'])->name('category_edit');
    Route::put('/category/{id}', [CategoryController::class, 'update'])->name('category_update');
    Route::delete('/category/{id}', [CategoryController::class, 'destroy'])->name('category_destroy');

    // Role
    Route::get('/role', [RoleController::class, 'index'])->name('role_index');
    Route::get('/role/create', [RoleController::class, 'create'])->name('role_create');
    Route::post('/role/save', [RoleController::class, 'store'])->name('role_store');
    Route::get('/role/{id}/edit', [RoleController::class, 'edit'])->name('role_edit');
    Route::put('/role/{id}', [RoleController::class, 'update'])->name('role_update');
    Route::delete('/role/{id}', [RoleController::class, 'destroy'])->name('role_destroy');

    // Article
    Route::get('/article', [ArticleController::class, 'index'])->name('article_index');
    Route::get('/article/create', [ArticleController::class, 'create'])->name('article_create');
    Route::post('/article/save', [ArticleController::class, 'store'])->name('article_store');
    Route::get('/article/{id}/edit', [ArticleController::class, 'edit'])->name('article_edit');
    Route::put('/article/{id}', [ArticleController::class, 'update'])->name('article_update');
    Route::delete('/article/{id}', [ArticleController::class, 'destroy'])->name('article_destroy');
    Route::patch('/article/{id}/publish', [ArticleController::class, 'publish'])->name('article_publish');
    Route::post('/ckeditor/upload', [ArticleController::class, 'uploadImage'])->name('ckeditor.upload');
    Route::patch('/article/{id}/recommended', [ArticleController::class, 'recommended'])->name('article_recommended');
});

// Page Profile
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile/{id}', [ProfileController::class, 'update'])->name('profile_update');
    Route::put('/change-password/{id}', [ProfileController::class, 'changePassword'])->name('change_password');
});

// Request Role
Route::post('/request-writer', [ProfileController::class, 'requestWriter'])->name('request_writer');

// Website
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/terms-conditions', function () {
    return view('web.termsConditions');
})->name('termsConditions');
Route::get('/terkini', [HomeController::class, 'show'])->name('terkini');
Route::get('/search', [HomeController::class, 'search'])->name('search');
Route::get('/rekomendasi', [HomeController::class, 'showRecommended'])->name('recommended');
Route::get('/populer', [HomeController::class, 'showPopular'])->name('popular');
Route::get('/{category:slug?}', [HomeController::class, 'show'])->name('show');
Route::get('/berita/{slug}', [HomeController::class, 'detail'])->name('detail');
Route::get('/tag/{tagslug}', [HomeController::class, 'showTag'])->name('showTag');
