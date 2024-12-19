<?php

namespace App\Models;

use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];

    // Relation to OrderDetails
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'product_id');
    }

    // Relation to TransferStocks
    public function transferStocks()
    {
        return $this->hasMany(TransferStock::class, 'product_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }
}
