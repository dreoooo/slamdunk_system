<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderItem extends Model
{
    use HasFactory;

    protected $table = 'ordered_items';

    public $incrementing = false; // Composite PK
    protected $primaryKey = null;

    protected $fillable = [
        'odr_id',
        'itm_number',
        'quantity_ordered',
        'quantity_shipped',
    ];

    protected $casts = [
        'quantity_ordered' => 'integer',
        'quantity_shipped' => 'integer',
    ];

    // Relationships
    public function order()
    {
        return $this->belongsTo(Order::class, 'odr_id', 'odr_id');
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'itm_number', 'itm_number');
    }

    // Optional: subtotal
    public function getSubtotalAttribute(): float
    {
        $lastPrice = $this->item->priceHistory->last() ?? null;
        return $lastPrice ? $this->quantity_ordered * $lastPrice->price : 0;
    }
}
