<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Warehouse;
use Carbon\Carbon;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $warehouses = Warehouse::all();
        foreach ($warehouses as $warehouse) {
            Product::insert([
                [
                    'name' => 'Product 1',
                    'sku' => 'P001-' . $warehouse->id,
                    'quantity' => 50,
                    'min_quantity' => 10,
                    'expiry_date' => Carbon::now()->addMonths(6),
                    'purchase_price' => 10,
                    'sale_price' => 15,
                    'warehouse_id' => $warehouse->id
                ],
                [
                    'name' => 'Product 2',
                    'sku' => 'P002-' . $warehouse->id,
                    'quantity' => 30,
                    'min_quantity' => 5,
                    'expiry_date' => Carbon::now()->addMonths(3),
                    'purchase_price' => 20,
                    'sale_price' => 30,
                    'warehouse_id' => $warehouse->id
                ]
            ]);
        }
    }
}
