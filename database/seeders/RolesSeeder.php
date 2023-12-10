<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        Role::create([
            'name' => 'Superadmin', 
            'status' => true,
            'description' => ''
        ]);        
        Role::create([
            'name' => 'Administrator', 
            'status' => true,
            'description' => ''
        ]);        
        Role::create([
            'name' => 'User', 
            'status' => true,
            'description' => ''
        ]);
    }
}
