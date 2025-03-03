<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'title',
        'description',
        'category_ref_id',
        'brand_ref_id',
        'price',
        'discount_price',
        'benefits_content',
        'ingredients_content',
        'howtouse_content',
        'product_size_id',
        'is_active',
    ];
}
