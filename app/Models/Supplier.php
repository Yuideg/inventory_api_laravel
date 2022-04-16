<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $primaryKey = 'supplier_id';
    protected $hidden = ['deleted_at','created_at','updated_at','password'];
    protected $fillable=['name','username','password','address','email','phone','fax'];





}
