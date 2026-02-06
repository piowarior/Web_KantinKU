<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::firstOrCreate(
            ['email' => 'admin@kantinku.test'],
            ['name' => 'Super Admin', 'password' => Hash::make('password')]
        );
        $user->assignRole('super_admin');

        $user = User::firstOrCreate(
            ['email' => 'kasir@kantinku.test'],
            ['name' => 'kasir', 'password' => Hash::make('password')]
        );
        $user->assignRole('user');
    }
}
