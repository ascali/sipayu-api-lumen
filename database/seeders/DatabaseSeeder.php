<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call('RolesTableSeeder');
        $this->call(RolesSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(TypeOfInterestSeeder::class);
        $this->call(DestinationSeeder::class);
    }
}
