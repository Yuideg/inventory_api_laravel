<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $primaryKey = 'order_id';
    protected $hidden = ['deleted_at','created_at','updated_at'];
    protected $fillable=['date_of_order','order_detail'];



}
