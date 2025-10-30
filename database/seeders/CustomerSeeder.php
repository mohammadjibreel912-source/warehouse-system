<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;

class CustomerSeeder extends Seeder
{
    public function run()
    {
        Customer::insert([
            ['name' => 'Customer A', 'phone' => '0791111111', 'address' => 'Amman'],
            ['name' => 'Customer B', 'phone' => '0782222222', 'address' => 'Irbid'],
            ['name' => 'Customer C', 'phone' => '0773333333', 'address' => 'Zarqa'],
        ]);
    }
}
