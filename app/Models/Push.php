<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Push extends Model
{
    protected $table = "push_subscriptions";
    public $timestamps = false;
    use HasFactory;
}
