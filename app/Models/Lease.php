<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lease extends Model
{
      protected $fillable = ['warehouse_id', 'start_date', 'end_date', 'rent_amount'];
protected $casts = [
    'start_date' => 'date',
    'end_date' => 'date',
];

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

}
