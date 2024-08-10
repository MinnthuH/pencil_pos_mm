<?php

namespace App\Models;

use App\Models\Shop;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TransferStock extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'from_shop_id',
        'to_shop_id',
        'product_id',
        'quantity',
        'created_at',
    ];

    protected $dates = ['deleted_at'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function toshop()
    {
        return $this->belongsTo(Shop::class, 'to_shop_id', 'id');
    }

    public function fromshop()
    {
        return $this->belongsTo(Shop::class, 'from_shop_id', 'id');
    }
}
