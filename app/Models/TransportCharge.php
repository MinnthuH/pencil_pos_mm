<?php

namespace App\Models;

use App\Models\Sale;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransportCharge extends Model
{
    use HasFactory;

    protected $fillable = ['sale_id', 'transport_id', 'staff_amount', 'owner_amount', 'created_at'];

    public function sale()
    {
        return $this->belongsTo(Sale::class, 'sale_id', 'id');
    }

}
