<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'), // غير كلمة المرور كما تريد
            'role' => 'admin',
        ]);

        // Warehouse Manager
        User::create([
            'name' => 'Warehouse Manager',
            'email' => 'warehouse@example.com',
            'password' => Hash::make('password123'),
            'role' => 'warehouse_manager',
        ]);

        // Sales user
        User::create([
            'name' => 'Sales User',
            'email' => 'sales@example.com',
            'password' => Hash::make('password123'),
            'role' => 'sales',
        ]);

        // Purchases user
        User::create([
            'name' => 'Purchases User',
            'email' => 'purchases@example.com',
            'password' => Hash::make('password123'),
            'role' => 'purchases',
        ]);

        // Accountant user
        User::create([
            'name' => 'Accountant User',
            'email' => 'accountant@example.com',
            'password' => Hash::make('password123'),
            'role' => 'accountant',
        ]);

        // Regular user
        User::create([
            'name' => 'Regular User',
            'email' => 'user@example.com',
            'password' => Hash::make('password123'),
            'role' => 'user',
        ]);

        // إنشاء مستخدمين عشوائيين إضافيين
        User::factory(5)->create();
    }
}
