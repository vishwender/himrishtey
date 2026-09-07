<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeActivityLog extends Model
{
    protected $table = 'employee_activity_logs';
    public $timestamps = false;
    use HasFactory;
}
