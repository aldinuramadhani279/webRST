<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Cek apakah user dengan email admin@gmail.com sudah ada
        $existingUser = User::where('email', 'admin@gmail.com')->first();

        if (! $existingUser) {
            User::create([
                'name' => 'Admin User',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('password'),
            ]);

            echo "Admin user created successfully!\n";
            echo "Email: admin@gmail.com\n";
            echo "Password: password\n";
        } else {
            echo "Admin user already exists!\n";
        }
    }
}
