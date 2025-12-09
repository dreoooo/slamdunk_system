<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CustomerAddress extends Model
{
    use HasFactory;

    // Table name
    protected $table = 'customers_addresses';

    // Primary Key
    protected $primaryKey = 'id';
    public $incrementing = false; // Primary key is string
    protected $keyType = 'string';

    // Mass assignable columns
    protected $fillable = [
        'id',
        'address_line_1',
        'address_line_2',
        'city',
        'postal_code',
        'ctr_number'
    ];

    /**
     * Auto-generate formatted ID: CAD001
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->id) {
                $last = self::orderBy('id', 'desc')->first();

                if ($last) {
                    // Extract numeric part (after CAD)
                    $number = (int) substr($last->id, 3);
                    $nextNumber = $number + 1;
                } else {
                    $nextNumber = 1;
                }

                // Format: CAD001
                $model->id = 'CAD' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
            }
        });
    }

    /**
     * Relationships
     */

    // CustomerAddress belongs to a Customer
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'ctr_number', 'ctr_number');
    }
}
