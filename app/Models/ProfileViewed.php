<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileViewed extends Model
{
    use HasFactory;
    protected $table = "profile_viewed";
    public $timestamps = false;
}