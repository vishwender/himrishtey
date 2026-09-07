<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRating extends Model
{
    protected $table = "user_rating";
    public $timestamps = false;
    use HasFactory;
    
    
}
