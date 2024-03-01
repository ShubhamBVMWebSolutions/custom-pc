<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
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

    public function product_rating($product_id){
        $product_rating=ProductRating::select(DB::raw('AVG(rating) as ratingAvg'))->where('product_id',$product_id)->first();
        if(!empty($product_rating)){
            return floor($product_rating->ratingAvg);
        }else{
            return 0;
        }
    }
    
    public function category_relation_products()
    {
        return $this->hasMany(ProductCategoryRelationship::class,'product_id');
    }

    public function tagsWithProduct()
    {
        return $this->belongsTo('App\Models\Tag','product_id');
    }

    public function wishlist_status($product_id)
    {
        if(!empty($product_id)){
            if(auth()->check()){
                $wishlist=Wishlist::where('user_id',auth()->user()->id)->where('product_id',$product_id)->first();
                if(!empty($wishlist)){
                    return 1;
                }else{
                    return 0;
                }
            }else{
                return 0;
            }
        }else{
            return 0;
        }
        
    }
}
