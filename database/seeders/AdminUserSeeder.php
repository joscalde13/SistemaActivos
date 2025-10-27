<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@carlinux.com'],
            [
                'name' => 'Admin TI',
                'password' => Hash::make('password123'), 
                'role' => 'admin',
            ]
        );
        

        
    }
}
