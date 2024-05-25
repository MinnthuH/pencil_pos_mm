<?php

namespace App\Models;

use App\Models\OrderDetail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Refurn extends Model
{
    use HasFactory;

    protected $fillable = ['sale_id', 'sale_item_id', 'refurnqty', 'refurn_amout'];

    public function sale()
    {
        return $this->belongsTo(Sale::class, 'sale_id', 'id');
    }

    public function saleitem()
    {
        return $this->belongsTo(OrderDetail::class, 'sale_item_id', 'id');
    }
}
