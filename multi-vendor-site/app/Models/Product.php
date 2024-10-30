<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;


    protected $table= 'products';
    protected $fillable = [
        'name',
        'description',
        'category',
        'price',
        'quantity',
        'image',
        'vendor_id'
    ];


    public function vendor():BelongsTo
    {
        return $this->belongsTo(Vendor::class);
    }
}
