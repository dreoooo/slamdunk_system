<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SalesRepAddress extends Model
{
    use HasFactory;

    protected $table = 'sales_representative_addresses';

    protected $primaryKey = 'id';
    public $incrementing = false; // ID is string
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'sre_id',
        'address_line_1',
        'address_line_2',
        'city',
        'postal_code'
    ];

    /**
     * Auto-generate formatted Address ID: SR01, SR02, ...
     */
    protected static function booted(): void
    {
        static::creating(function ($model) {
            if (!$model->id) {
                $last = self::orderBy('id', 'desc')->first();
                $number = $last ? (int) substr($last->id, 2) + 1 : 1;
                $model->id = 'SR' . str_pad($number, 2, '0', STR_PAD_LEFT);
            }
        });
    }

    /**
     * Relationship: Address → Sales Representative
     */
    public function salesRep()
    {
        return $this->belongsTo(SalesRepresentative::class, 'sre_id', 'id');
    }
}
