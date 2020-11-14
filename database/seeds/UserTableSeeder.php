<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create super admin user
        $user = User::create([
            'name' => 'KPIC Super Admin',
            'email' => 'superadmin@example.com',
            'email_verified_at' => now(),
            'activated_at' => now(),
            'password' => Hash::make('Secret1234!')
        ]);

        $user->assignRole('super admin');

        // Create admin user
        $user = User::create([
            'name' => 'KPIC Admin',
            'email' => 'admin@example.com',
            'email_verified_at' => now(),
            'activated_at' => now(),
            'password' => Hash::make('Secret1234!')
        ]);

        $user->assignRole('admin');
    }
}
