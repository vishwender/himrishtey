<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shortlist extends Model
{
    use HasFactory;

    protected $table = 'short_listed';   // your custom table
    protected $guarded = [];
    public $timestamps = false;

    // protected $hidden = ['password', 'remember_token'];
}

