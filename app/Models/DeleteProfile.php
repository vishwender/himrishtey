<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeleteProfile extends Model
{
    use HasFactory;
    protected $table = "delete_profile_request";
    protected $fillable = [
        'user_id',
        'reason',
        'date',
        'status',
    ];
    public $timestamps = false;
}
