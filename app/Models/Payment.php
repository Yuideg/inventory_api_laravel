<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $primaryKey = 'bill_number';
    protected $hidden = ['deleted_at','created_at','updated_at'];
    protected $fillable=['payment_type','description'];




}
