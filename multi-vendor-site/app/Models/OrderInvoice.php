<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderInvoice extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;


    protected $table= 'order_invoice';
    protected $fillable = [
        'address',
        'phone',
        'vendor_id',
        'user_id',
    ];


    public function order():BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
