<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberWallet extends Model
{
    protected $table = "member_wallet";
    use HasFactory;
    protected $fillable = [];
    protected $guarded = [];
    public $timestamps = false;
}
