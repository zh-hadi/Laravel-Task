<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentLedger extends Model
{
    use HasFactory;
    protected $table = 'payment_ledger';
}
