<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnnualIncome extends Model
{
    protected $table = 'annual_incomes';
    public $timestamps = false;
    use HasFactory;
}
