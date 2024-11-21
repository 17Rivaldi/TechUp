<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManager;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Drivers\Gd\Driver;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::find(auth()->id());
        $totalArticle = Article::where('user_id', auth()->id())->count();
        $totalViews = Article::where('user_id', auth()->id())->sum('views');
        return view('dashboard.profile', compact('users', 'totalArticle', 'totalViews'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Update Profile
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password'  => 'nullable|min:6|confirmed',
            'phone_number' => 'nullable|string|max:15',
            'birthdate' => 'nullable|date',
            'gender' => 'nullable|in:male,female',
            'profile_image' => 'nullable|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $user = User::findOrFail($id);

        if ($request->hasFile('profile_image')) {
            if ($user->image && Storage::disk('public')->exists('image-profile/' . $user->image)) {
                Storage::disk('public')->delete('image-profile/' . $user->image);
            }

            $image = $request->file('profile_image');
            $image_name = date('ymdHis') . '_' . $image->getClientOriginalName();
            $image->storeAs('image-profile', $image_name, 'public');

            $imgManager = new ImageManager(new Driver());
            $thumbImage = $imgManager->read(storage_path('app/public/image-profile/' . $image_name));
            $thumbImage->resize(150, 150);

            $thumbImage->save(storage_path('app/public/image-profile/' . $image_name));
        }

        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->filled('password') ? Hash::make($request->input('password')) : $user->password,
            'phone_number' => $request->input('phone_number'),
            'birthdate' => $request->input('birthdate'),
            'gender' => $request->input('gender'),
            'profile_image' => isset($image_name) ? $image_name : $user->profile_image,
        ]);

        Alert::success('success', 'User Berhasil Perbaharui');
        return redirect()->route('profile');
    }

    public function changePassword(Request $request, string $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'current_password' => 'required|current_password',
                'password'  => 'nullable|min:6|confirmed',
            ],
            [
                'current_password.required' => 'Please enter your current password.',
                'current_password.current_password' => 'The current password is incorrect. Please try again.',
                'password.confirmed' => 'The confirmation password does not match.',
            ]
        );

        if ($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $user = User::findOrFail($id);

        $user->update([
            'password' => Hash::make($request->input('password'))
        ]);

        Alert::success('success', 'Password Berhasil Diubah');
        return redirect()->route('profile');
    }
}
