<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Supplier;

class SupplierSeeder extends Seeder
{
    public function run()
    {
        Supplier::insert([
            ['name' => 'Supplier 1', 'phone' => '0791234567', 'address' => 'Amman'],
            ['name' => 'Supplier 2', 'phone' => '0787654321', 'address' => 'Irbid'],
            ['name' => 'Supplier 3', 'phone' => '0779876543', 'address' => 'Zarqa'],
        ]);
    }
}
