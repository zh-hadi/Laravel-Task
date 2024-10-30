<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;


    protected $table= 'orders';
    protected $fillable = [
        'user_id',
        'product_id',
        'vendor_id',
        'order_invoice_id',
    ];


    public function order_invoice():HasOne
    {
        return $this->hasOne(OrderInvoice::class);
    }
}
