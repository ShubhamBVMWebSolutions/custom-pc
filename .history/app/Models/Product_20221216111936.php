<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'id',
        'title',
        'product_overview',
        'material',
        'details',
        'short_description',
        'features',
        'product_categories',
        'price',
        'sale_price',
        'brand',
        'model',
        'sku',
        'rating',
        'stock_qty',
        'image',
        'featured',
        'slug',
        'status',
        'meta_keywords',
        'meta_description',
        'product_type'
    ];


    /**
     * Get the reviews of the product.
     */
    public function product_ratings()
    {
        return $this->hasMany(ProductRating::class);
    }
}
