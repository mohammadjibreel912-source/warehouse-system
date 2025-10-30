<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lease extends Model
{
      protected $fillable = ['warehouse_id', 'start_date', 'end_date', 'rent_amount'];

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

}
