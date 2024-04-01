<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FuelEntry extends Model
{
    use HasFactory;
    protected $fillable = [
        'fuel_type', 'fuel_price', 'fuel_amount', 'fuel_date', 'kilometers_traveled', 'oil_type', 'oil_name', 'service_date'
    ];
    protected $casts = [
        'fuel_price' => 'integer',
        'fuel_amount' => 'integer',
        'kilometers_traveled' => 'integer'
    ];
}
