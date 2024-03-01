<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChipsetSubCategory extends Model
{
    use HasFactory;
    public $table = 'chipset_sub_category';
    
    public function product1_details()
    {
        return $this->belongsTo(Product::class,'product_id1','id');
    }
    
    public function product2_details()
    {
        return $this->belongsTo(Product::class,'product_id2','id');
    }
    
    public function product3_details()
    {
        return $this->belongsTo(Product::class,'product_id3','id');
    }
    
    public function product4_details()
    {
        return $this->belongsTo(Product::class,'product_id4','id');
    }
}
