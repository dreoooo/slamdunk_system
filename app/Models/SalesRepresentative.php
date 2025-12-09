<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SalesRepresentative extends Model
{
    use HasFactory;

    protected $table = 'sales_representatives'; // Ensures table name matches migration

    protected $primaryKey = 'id';
    public $incrementing = false; // ID is string
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'email',
        'first_name',
        'last_name',
        'phone_number',
        'commission_rate',
        'supervisor_id'
    ];

    /**
     * Auto-generate formatted ID: SREP0001
     */
    protected static function booted(): void
    {
        static::creating(function ($model) {
            if (!$model->id) {
                $lastRep = self::orderBy('id', 'desc')->first();
                $number = $lastRep ? (int) substr($lastRep->id, 4) + 1 : 1;
                $model->id = 'SREP' . str_pad($number, 4, '0', STR_PAD_LEFT);
            }
        });
    }

    /**
     * Relationships
     */

    // Supervisor (self-referencing)
    public function supervisor()
    {
        return $this->belongsTo(SalesRepresentative::class, 'supervisor_id', 'id');
    }

    // Subordinates
    public function subordinates()
    {
        return $this->hasMany(SalesRepresentative::class, 'supervisor_id', 'id');
    }

    // SalesRep → Customers
    public function customers()
    {
        return $this->hasMany(Customer::class, 'sre_id', 'id');
    }

    // SalesRep → Addresses
    public function addresses()
    {
        return $this->hasMany(SalesRepAddress::class, 'sre_id', 'id');
    }
}
