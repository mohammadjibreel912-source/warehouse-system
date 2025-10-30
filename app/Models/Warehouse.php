<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
        protected $fillable = ['name', 'location'];

    // علاقة المستودع بعقود الإيجار
    public function leases()
    {
        return $this->hasMany(Lease::class);
    }

    // علاقة المستودع بالمنتجات
    public function products()
    {
        return $this->hasMany(Product::class);
    }

      public function currentLease()
    {
        return $this->hasOne(Lease::class)->latestOfMany();
        // latestOfMany() تجلب آخر عقد مرتبط بالمستودع
    }
}
