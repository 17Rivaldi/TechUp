<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
        return view('dashboard.admin.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.admin.role.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $role = Role::firstOrCreate(
            ['name' => $request->name],
            ['guard_name' => 'web']
        );

        Alert::success('success', 'Role Berhasil Dibuat');
        return redirect()->route('role_index');
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
        $roles = Role::find($id);

        // Cek apakah role adalah "admin"
        if ($roles->name === 'admin') {
            Alert::error('error', 'Role admin tidak bisa diedit.');
            return redirect()->route('role_index');
        }

        return view('dashboard.admin.role.edit', compact('roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $role = Role::find($id);
        $role->name = $request->name;
        $role->save();

        Alert::success('success', 'Role Berhasil Diperbarui');
        return redirect()->route('role_index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::findOrFaIl($id);

        // Cek apakah role adalah "admin"
        if ($role->name === 'admin') {
            Alert::error('error', 'Role admin tidak bisa dihapus.');
            return redirect()->route('role_index');
        }

        $role->delete();

        Alert::success('success', 'Data Berhasil di Hapus');
        return redirect()->route('role_index');
    }
}
