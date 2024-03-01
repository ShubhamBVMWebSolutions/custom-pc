<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCollection extends Model
{
    use HasFactory;
    
    public function parent_collection(){
        return $this->belongsTo(ProductCollection::class,'parent_id');
    }
    
    public function childs() {
        return $this->hasMany(ProductCollection::class,'parent_id','id')->where('status','Active') ;
    }
}
