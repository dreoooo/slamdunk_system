<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Model
{
    use HasFactory;

    protected $table = 'items';
    protected $primaryKey = 'itm_number';
    public $incrementing = false; // because itm_number is string
    protected $keyType = 'string';

    protected $fillable = [
        'itm_number',
        'name',
        'description',
        'category',
        'color',
        'size',
        'ilt_id',
    ];

    /**
     * Auto-generate itm_number when creating a new item
     */
    protected static function booted(): void
    {
        static::creating(function ($item) {
            if (empty($item->itm_number)) {
                $lastItem = self::orderBy('itm_number', 'desc')->first();
                $number = $lastItem ? intval(substr($lastItem->itm_number, 3)) + 1 : 1;
                $item->itm_number = 'ITM' . str_pad($number, 3, '0', STR_PAD_LEFT);
            }
        });
    }

    // Relationships
    public function inventory()
    {
        return $this->belongsTo(Inventory::class, 'ilt_id', 'id');
    }

    public function orderedItems()
    {
        return $this->hasMany(OrderItem::class, 'itm_number', 'itm_number');
    }

    public function priceHistory()
    {
        return $this->hasMany(PriceHistory::class, 'itm_number', 'itm_number')
            ->orderBy('start_date')->orderBy('start_time');
    }
}
