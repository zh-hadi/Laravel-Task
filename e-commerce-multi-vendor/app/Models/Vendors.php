<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vendors extends Model
{
    use HasFactory;
    protected $fillable = [
        'company_name',
        'address',
        'logo',
        'user_id'
    ];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    public function products():HasMany
    {
        return $this->hasMany(Product::class);
    }
}
