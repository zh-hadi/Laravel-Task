<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleLedger extends Model
{
    use HasFactory;
    protected $table = 'sale_ledger';
    protected $fillable = ['vendor_id','sale_amount'];
}
