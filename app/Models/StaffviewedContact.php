<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffviewedContact extends Model
{
    protected $table = 'staff_viewed_contacts';
    protected $fillable = ['member_name','staff','created_at','profile_id'];
    public $timestamps = false;
    use HasFactory;
}