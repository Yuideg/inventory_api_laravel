<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;


class Staff extends Model
{
    use HasFactory,HasApiTokens;
    protected $primaryKey = 'staff_id';
    protected $hidden = ['deleted_at','created_at','updated_at','password'];
    protected $fillable=['first_name','last_name','username','password','address','email','phone','role_id'];





}
