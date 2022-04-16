<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $primaryKey = 'order_detail_id';
    protected $hidden = ['deleted_at','created_at','updated_at'];
    protected $fillable=['unit_price','size','quantity','discount','total','date','product_id','order_id','bill_number'];





}
