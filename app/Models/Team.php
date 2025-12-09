<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Team extends Model
{
    use HasFactory;

    protected $table = 'teams'; // Ensure table matches migration

    protected $primaryKey = 'id';
    public $incrementing = false; // ID is string
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'name',
        'number_of_players',
        'discount'
    ];

    /**
     * Relationships
     */

    // Team → Customers (1:N)
    public function customers()
    {
        return $this->hasMany(Customer::class, 'tem_id', 'id');
    }
}
