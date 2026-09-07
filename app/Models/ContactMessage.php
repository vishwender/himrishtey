<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_key', 'name', 'email', 'phone', 'profile_id', 'subject',
        'message', 'ip_address', 'user_agent',
    ];
}
