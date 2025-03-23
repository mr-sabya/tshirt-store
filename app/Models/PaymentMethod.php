<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'is_active',
        'bkash_number',
        'bank_account_number',
        'third_party_gateway_details',
    ];

    protected $casts = [
        'bank_account_number' => 'encrypted',  // Automatically encrypts/decrypts when stored/retrieved
    ];
}
