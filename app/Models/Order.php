<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $primaryKey = 'odr_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'odr_id',
        'ctr_number',
        'odr_date',
        'odr_time',
        'number_of_units',
    ];

    protected $casts = [
        'odr_date' => 'date',
        'odr_time' => 'datetime',
        'number_of_units' => 'integer',
    ];

    // Auto-generate Order ID (ORD0001, ORD0002...)
    protected static function booted()
    {
        static::creating(function ($order) {
            if (empty($order->odr_id)) {
                $last = self::orderBy('odr_id', 'desc')->first();
                $num = $last ? intval(substr($last->odr_id, 3)) + 1 : 1;
                $order->odr_id = 'ORD' . str_pad($num, 4, '0', STR_PAD_LEFT);
            }
        });
    }

    // Relationships

    // Order belongs to a customer
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'ctr_number', 'ctr_number');
    }

    // Order has many ordered items
    public function orderedItems()
    {
        return $this->hasMany(OrderItem::class, 'odr_id', 'odr_id');
    }

    // Convenient accessor to get all items in the order
    public function items()
    {
        return $this->hasManyThrough(
            Item::class,
            OrderItem::class,
            'odr_id',      // Foreign key on ordered_items
            'itm_number',  // Foreign key on items
            'odr_id',      // Local key on orders
            'itm_number'   // Local key on ordered_items
        );
    }
}
