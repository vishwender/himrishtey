<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserActivity extends Model
{
    protected $table = "user_activity";
    public $timestamps = false;
    use HasFactory;
}