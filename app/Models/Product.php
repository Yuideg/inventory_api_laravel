<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $primaryKey = 'product_id';
    protected $hidden = ['deleted_at','created_at','updated_at'];
    protected $fillable=['name','description','unit','price','quantity','status','supplier_id','category_id'];



}
