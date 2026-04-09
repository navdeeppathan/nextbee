<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Product extends Model
{
    use HasFactory;

    // 🔥 ADD THIS (VERY IMPORTANT)
    protected $fillable = [
        'title',
        'description',
        'price',
        'image',
        'category_id',
         'sku_code',
        'moq',
        'shelf_life',
        'aisle',
        'rack',
        'basket',
        'quantity',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}