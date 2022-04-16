<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable=['category_name','description'];
    protected $primaryKey = 'category_id';
    protected $hidden = ['deleted_at','created_at','updated_at'];




}
