<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InventoryMovement extends Model
{
    use HasFactory;

    // جميع أنواع الحركات المخزنية
    const TYPE_IN = 'in';
    const TYPE_OUT = 'out';
    const TYPE_INITIAL_STOCK = 'initial_stock';
    const TYPE_PURCHASE = 'purchase';
    const TYPE_SALE = 'sale';
    const TYPE_SALE_ADJUSTED = 'sale_adjusted';
    const TYPE_SALE_DELETED = 'sale_deleted';
    const TYPE_ADJUSTMENT = 'adjustment';
    const TYPE_PURCHASE_DELETED = 'purchase_deleted'; // للحذف

    protected $fillable = [
        'product_id',
        'type',
        'quantity',
        'note',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public static function types(): array
    {
        return [
            self::TYPE_IN,
            self::TYPE_OUT,
            self::TYPE_INITIAL_STOCK,
            self::TYPE_PURCHASE,
            self::TYPE_SALE,
            self::TYPE_SALE_ADJUSTED,
            self::TYPE_SALE_DELETED,
            self::TYPE_ADJUSTMENT,
            self::TYPE_PURCHASE_DELETED,
        ];
    }
}
