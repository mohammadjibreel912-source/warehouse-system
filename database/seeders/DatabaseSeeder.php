<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       $this->call([
        WarehouseSeeder::class,
        LeaseSeeder::class,
        ProductSeeder::class,
        SupplierSeeder::class,
        CustomerSeeder::class,
        PurchaseSeeder::class,
        SaleSeeder::class,
        NotificationSeeder::class,
    ]);

    }
}
