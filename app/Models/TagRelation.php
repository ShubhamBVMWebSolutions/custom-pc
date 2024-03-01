<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagRelation extends Model
{
    use HasFactory;
    public function tags()
    {
        return $this->belongsTo('App\Models\Tag','tag_id');
    }
}
