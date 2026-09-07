<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ViewedContact extends Model
{
    use HasFactory;
    protected $table = "viewed_contacts";
    public $timestamps = false;
}