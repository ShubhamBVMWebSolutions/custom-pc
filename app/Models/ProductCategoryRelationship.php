<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategoryRelationship extends Model
{
    use HasFactory;
    public $table = 'product_category_relations';
    
    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }
    
    public function category()
    {
        return $this->belongsTo(ProductCategory::class,'category_id');
    }
}
