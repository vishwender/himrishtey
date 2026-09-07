<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SentInterest extends Model
{
    use HasFactory;
    protected $table = "sent_interests";
    public $timestamps = false;
}