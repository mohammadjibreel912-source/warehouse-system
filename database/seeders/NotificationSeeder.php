<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Notification;
use Carbon\Carbon;

class NotificationSeeder extends Seeder
{
    public function run()
    {
        Notification::insert([
            [
                'type' => 'Low Stock',
                'message' => 'Product 1 is below minimum quantity',
                'related_id' => 1,
                'read_at' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'type' => 'Lease Expiring',
                'message' => 'Lease for Warehouse A expires soon',
                'related_id' => 1,
                'read_at' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);
    }
}
