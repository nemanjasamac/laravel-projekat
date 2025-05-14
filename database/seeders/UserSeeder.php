<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@pwa.rs',
            'password' => Hash::make('admin'),
            'role' => 'admin'
        ]);

        User::create([
            'name' => 'Editor User',
            'email' => 'editor@pwa.rs',
            'password' => Hash::make('editor'),
            'role' => 'editor'
        ]);

        User::create([
            'name' => 'Regular User',
            'email' => 'user@pwa.rs',
            'password' => Hash::make('user'),
            'role' => 'registered'
        ]);
        User::create([
            'name' => 'Nemanja Samac',
            'email' => 'nsamac@raf.rs',
            'password' => Hash::make('nsamac'),
            'role' => 'admin'
        ]);
        User::create([
            'name' => 'Stefan Edelman',
            'email' => 'stefan@raf.rs',
            'password' => Hash::make('stefan'),
            'role' => 'editor'
        ]);
        User::create([
            'name' => 'Viktor Todorovic',
            'email' => 'viktor@raf.rs',
            'password' => Hash::make('viktor'),
            'role' => 'registered'
        ]);
    }
}