<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('dashboard.admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        Category::create([
            'name' => strtolower($request->input('name')),
        ]);

        Alert::success('success', 'Category Berhasil ditambah');
        return redirect()->route('category_index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category, $id)
    {
        $categories = Category::find($id);
        return view('dashboard.admin.category.edit', compact('categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $category = Category::findOrFaIl($id);
        $category->name = strtolower($request->input('name'));
        $category->save();

        Alert::success('success', 'Category Berhasil diubah');
        return redirect()->route('category_index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFaIl($id);

        if (!$category) {
            Alert::error('error', 'Category tidak ditemukan.');
            return redirect()->route('category_index');
        }
        $category->delete();

        Alert::success('success', 'Category Berhasil di Hapus');
        return redirect()->route('category_index');
    }
}
