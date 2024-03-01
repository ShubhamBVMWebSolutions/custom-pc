<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    use HasFactory;
    
    public function blogs()
    {
        return $this->hasMany(Blog::class,'blog_category_id');
    }
    
    public function product_category()
    {
        return $this->belongsTo(ProductCategory::class,'product_category_id');
    }
}
