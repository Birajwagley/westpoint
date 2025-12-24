<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $user = User::create([
            'name' => 'superadmin',
            'username' => 'superadmin',
            'email' => 'superadmin@gbbs.com',
            'password' => Hash::make('gbbs@098'),
            'is_active' => true,
        ]);

        $user->createToken('api-token')->plainTextToken;

        $user->assignRole('superadmin');
    }
}
