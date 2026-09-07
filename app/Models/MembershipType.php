<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MembershipType extends Model
{
    use HasFactory;
    protected  $table = "membership_type";
    public $timestamps = false;

    public function membershipPlans()
    {
        return $this->belongsTo(MembershipPlan::class);
    }
}
