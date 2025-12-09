<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory;

    // Table name
    protected $table = 'customers';

    // Primary Key
    protected $primaryKey = 'ctr_number';
    public $incrementing = false; // Primary key is string
    protected $keyType = 'string';

    // Mass assignable columns
    protected $fillable = [
        'ctr_number',
        'email',
        'first_name',
        'last_name',
        'phone_number',
        'current_balance',
        'loyalty_card_number',
        'tem_id',
        'sre_id'
    ];

    /**
     * Auto-generate formatted ID: CTR001
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->ctr_number) {
                $lastCustomer = self::orderBy('ctr_number', 'desc')->first();

                if ($lastCustomer) {
                    // Extract numeric part and add +1
                    $number = (int) substr($lastCustomer->ctr_number, 3); // Remove 'CTR'
                    $nextNumber = $number + 1;
                } else {
                    $nextNumber = 1; // First record
                }

                // Format: CTR001 (6 characters)
                $model->ctr_number = 'CTR' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
            }
        });
    }

    /**
     * Relationships
     */

    // Customer can have multiple addresses
    public function addresses()
    {
        return $this->hasMany(CustomerAddress::class, 'ctr_number', 'ctr_number');
    }

    // Customer can have multiple orders
    public function orders()
    {
        return $this->hasMany(Order::class, 'ctr_number', 'ctr_number');
    }

    // Customer belongs to a team (optional)
    public function team()
    {
        return $this->belongsTo(Team::class, 'tem_id', 'id');
    }

    // Customer belongs to a sales representative (optional)
    public function salesRep()
    {
        return $this->belongsTo(SalesRepresentative::class, 'sre_id', 'id');
    }
}
