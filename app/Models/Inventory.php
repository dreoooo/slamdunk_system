<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Inventory extends Model
{
    use HasFactory;

    protected $table = 'inventory_list';

    // Primary Key
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'cost',
        'units'
    ];

    // Auto-generate formatted ID: INV001
    protected static function booted()
    {
        static::creating(function ($model) {
            if (!$model->id) {
                $last = self::orderBy('id', 'desc')->first();
                $nextNumber = $last ? (int) substr($last->id, 3) + 1 : 1;
                $model->id = 'INV' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
            }
        });
    }

    // Relationship: Inventory → Items
    public function items()
    {
        return $this->hasMany(Item::class, 'ilt_id', 'id');
    }
}
