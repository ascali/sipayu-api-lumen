<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'id_role' => 1,
            'name' => 'Super User SIPAYU',
            'email' => 'su.siayu@yopmail.com',
            'password' => Hash::make('password1'),
        ]);
        User::create([
            'id_role' => 2,
            'name' => 'Admin SIPAYU', 
            'email' => 'admin.sipayu@yopmail.com',
            'password' => Hash::make('password2')
        ]);
        User::create([
            'id_role' => 3,
            'name' => 'Alan Walker', 
            'email' => 'alanwalker@yopmail.com',
            'password' => Hash::make('password3')
        ]);
    }
}
