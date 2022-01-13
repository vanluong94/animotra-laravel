<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'username' => 'superadmin',
            'name'     => 'Super Admin',
            'email'    => 'superadmin@aptech.com',
            'password' => Hash::make('123456'),
            'role'     => 'admin',
        ]);
    }
}
