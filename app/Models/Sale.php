<?php

namespace App\Models;

use App\Models\Customer;
use App\Models\Deli;
use App\Models\Refurn;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sale extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function deli()
    {
        return $this->belongsTo(Deli::class, 'deli_id', 'id');
    }

    public function refurn()
    {
        return $this->hasMany(Refurn::class, 'sale_id', 'id');
    }
}
