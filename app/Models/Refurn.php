<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Refurn extends Model
{
    use HasFactory;

    protected $fillable = ['sale_id', 'sale_item_id', 'refurnqty', 'refurn_amout'];
}
