<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HighlightProduct extends Model
{
    use HasFactory;
    protected $table = "highlightproduct";
    protected $primarykey = "id";
    protected $fillable = [
        'image1', 'link1', 'image2', 'link2', 'image3', 'link3'
    ];
}
