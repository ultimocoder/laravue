<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'pro_name',
        'pro_des',
        'pro_cat',
        'pro_sub_cat',
        'pro_fe_image',
        'pro_images',
        'pro_slug'
    ];   
}
 