<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PriceHistory extends Model
{
    use HasFactory;

    protected $table = 'price_history';

    public $incrementing = false; // Composite PK
    protected $primaryKey = null;
    public $timestamps = false;

    protected $fillable = [
        'itm_number',
        'price',
        'start_date',
        'start_time',
        'end_date',
        'end_time',
    ];

    // Cast dates to Carbon, keep times as strings
    protected $casts = [
        'start_date' => 'date',
        'end_date'   => 'date',
        'start_time' => 'string', // TIME column expects HH:MM:SS
        'end_time'   => 'string',
    ];

    // Relationship with Item
    public function item()
    {
        return $this->belongsTo(Item::class, 'itm_number', 'itm_number');
    }
}
