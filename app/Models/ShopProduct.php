<?php

namespace App\Models;

use App\Models\Shop;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ShopProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'shop_id',
        'product_id',
        'quantity',
        'created_at',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class, 'shop_id', 'id');
    }
}
