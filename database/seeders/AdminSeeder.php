<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@domain.com',
            'is_admin' => '1',
            'password' => Hash::make('12345678'),
            'active' => '1',
        ]);
        User::create([
            'name' => 'User',
            'email' => 'user@domain.com',
            'is_admin' => '0',
            'password' => Hash::make('12345678'),
            'active' => '1',
          
        ]);
    }
}
