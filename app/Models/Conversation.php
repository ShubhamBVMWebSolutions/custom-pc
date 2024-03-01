<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Conversation extends Model
{
    use HasFactory;
    
    
    public function second_person(){
        return $this->belongsTo(User::class,'second_person_id');
    }
}
