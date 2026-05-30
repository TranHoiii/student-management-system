<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@thm.vn'],
            [
                'name' => 'Administrator',
                'phone' => '0986039287',
                'role' => 'admin',
                'password' => Hash::make('Admin@123456'),
            ]
        );
    }
}
