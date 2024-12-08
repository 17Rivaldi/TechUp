<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Auth\Events\Verified;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Add Data Role
        $roles = ['admin', 'writer', 'editor', 'user'];
        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role, 'guard_name' => 'web']);
        }

        // Add User with Role
        $admin = User::firstOrCreate([
            'email' => 'admin@role.id',
        ], [
            'name' => 'Admin',
            'password' => Hash::make('admin123'),
        ]);

        $admin->assignRole('admin');

        // Email Verified
        if (!$admin->hasVerifiedEmail()) {
            $admin->markEmailAsVerified();
            event(new Verified($admin));
        }

        // Add Data Category
        $categories = [
            'game',
            'review',
            'tutorial',
            'gadget'
        ];
        foreach ($categories as $categoryName) {
            Category::create([
                'name' => $categoryName
            ]);
        }
    }
}
