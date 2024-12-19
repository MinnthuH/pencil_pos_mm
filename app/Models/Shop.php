<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;
    protected $guarded = [];

    // Relation to Sales
    public function sales()
    {
        return $this->hasMany(Sale::class, 'shop_id');
    }

    // Relation to TransferStocks as "From Shop"
    public function transferFromStocks()
    {
        return $this->hasMany(TransferStock::class, 'from_shop_id');
    }

    // Relation to TransferStocks as "To Shop"
    public function transferToStocks()
    {
        return $this->hasMany(TransferStock::class, 'to_shop_id');
    }
}
