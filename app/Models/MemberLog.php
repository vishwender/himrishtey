<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberLog extends Model
{
    use HasFactory;

    protected $table = 'member_logs';

    public $timestamps = false;
}
