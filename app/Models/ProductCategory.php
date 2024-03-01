<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;
    public $table = 'product_category';
    
    public function products()
    {
        return $this->hasMany(ProductCategoryRelationship::class,'category_id');
    }
}
