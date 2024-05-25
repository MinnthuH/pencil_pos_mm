<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransportCharge extends Model
{
    use HasFactory;

    protected $fillable = ['sale_id', 'transport_id', 'staff_amount', 'owner_amount', 'created_at'];
}
