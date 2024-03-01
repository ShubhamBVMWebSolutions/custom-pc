<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariation extends Model
{
    use HasFactory;

    public function color_details(){
        return $this->belongsTo(ColorAttribute::class,"color_id");
    }
    public function ssd_details(){
        return $this->belongsTo(SSD::class,"ssd_id");
    }
    public function screen_size_details(){
        return $this->belongsTo(ScreenSize::class,"screen_size_id");
    }
    public function ram_details(){
        return $this->belongsTo(RAM::class,"ram_id");
    }
}
