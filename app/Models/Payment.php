<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Invoice;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id',
        'amount',
        'payment_date',
        'payment_method',
    ];
  protected $casts = [
        'payment_date' => 'date', // Cast to Carbon
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
