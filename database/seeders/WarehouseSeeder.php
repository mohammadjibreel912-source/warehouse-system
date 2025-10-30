<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Warehouse;

class WarehouseSeeder extends Seeder
{
    public function run()
    {
        Warehouse::insert([
            ['name' => 'Warehouse A', 'location' => 'Amman'],
            ['name' => 'Warehouse B', 'location' => 'Irbid'],
            ['name' => 'Warehouse C', 'location' => 'Zarqa'],
        ]);
    }
}
