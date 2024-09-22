<?php

namespace App\Models;

use App\Models\Shop;
use App\Models\OrderDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Refurn extends Model
{
    use HasFactory;

    protected $fillable = ['sale_id','shop_id', 'sale_item_id', 'refurnqty', 'refurn_amout'];

    public function sale()
    {
        return $this->belongsTo(Sale::class, 'sale_id', 'id');
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class, 'shop_id', 'id');
    }

    public function saleitem()
    {
        return $this->belongsTo(OrderDetail::class, 'sale_item_id', 'id');
    }
}
