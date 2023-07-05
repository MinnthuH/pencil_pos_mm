<?php

namespace App\Models;

use App\Models\User;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sale extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function customer(){
        return $this->belongsTo(Customer::class,'customer_id','id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
