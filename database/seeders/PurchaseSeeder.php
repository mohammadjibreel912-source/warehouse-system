<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\Product;
use Carbon\Carbon;

class PurchaseSeeder extends Seeder
{
    public function run()
    {
        $suppliers = Supplier::all();
        $products = Product::all();

        foreach ($products as $product) {
            Purchase::create([
                'supplier_id' => $suppliers->random()->id,
                'product_id' => $product->id,
                'quantity' => rand(5, 20),
                'cost' => rand(50, 200),
                'purchase_date' => Carbon::now()->subDays(rand(1, 30))
            ]);
        }
    }
}
