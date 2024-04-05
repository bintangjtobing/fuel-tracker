<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\FuelEntry;

class Transaction extends Model
{
    protected $fillable = [
        'transaction_date', 'product_name', 'type_of_product', 'quantity', 'unit_price', 'discount_price', 'total_price'
    ];

    protected $casts = [
        'quantity' => 'integer',
        'unit_price' => 'integer',
        'discount_price' => 'integer',
        'total_price' => 'integer',
    ];

    public function totalExpenses()
    {
        return $this->sum('total_price');
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($transaction) {
            $transaction->total_price = ($transaction->quantity * $transaction->unit_price) - $transaction->discount_price;
        });

        static::created(function ($transaction) {
            if ($transaction->type_of_product === 'oli') {
                FuelEntry::create([
                    'fuel_price' => '0',
                    'fuel_amount' => '0',
                    'kilometers_traveled' => '0',
                    'oil_type' => 'Oli Motor Sport',
                    'oil_name' => $transaction->product_name,
                    'service_date' => $transaction->transaction_date,
                ]);
            } elseif ($transaction->type_of_product === 'servis') {
                FuelEntry::create([
                    'fuel_price' => '0',
                    'fuel_amount' => '0',
                    'kilometers_traveled' => '0',
                    'service_date' => $transaction->transaction_date,
                ]);
            }
        });
    }
}

