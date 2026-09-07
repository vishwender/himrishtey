<?php

namespace Tests\Feature;

use App\Services\HomepageProfiles;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class HomepageProfilesTest extends TestCase
{
    public function test_it_selects_fifteen_latest_eligible_profiles_in_alternating_order(): void
    {
        config(['database.default' => 'sqlite', 'database.connections.sqlite.database' => ':memory:']);
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            foreach (['gender', 'active', 'member_type', 'profile_hide', 'photo_approved', 'photo'] as $column) {
                $table->string($column)->nullable();
            }
        });
        $base = ['active' => 'Yes', 'member_type' => 'Verified', 'profile_hide' => 'No', 'photo_approved' => 'Yes', 'photo' => 'portrait.jpg'];
        foreach (['Male', 'Female'] as $gender) {
            for ($i = 0; $i < 10; $i++) {
                DB::table('members')->insert($base + ['gender' => $gender]);
            }
            foreach ([['active' => 'No'], ['member_type' => 'Free'], ['profile_hide' => 'Yes'], ['photo_approved' => 'No'], ['photo' => ' '], ['photo' => null]] as $invalid) {
                DB::table('members')->insert(array_replace($base + ['gender' => $gender], $invalid));
            }
        }
        $profiles = app(HomepageProfiles::class)->get();
        $this->assertSame(['Male', 'Female', 'Male', 'Female', 'Male', 'Female', 'Male', 'Female', 'Male', 'Female', 'Male', 'Female', 'Male', 'Female', 'Male'], $profiles->pluck('gender')->all());
        $this->assertSame([10, 26, 9, 25, 8, 24, 7, 23, 6, 22, 5, 21, 4, 20, 3], $profiles->pluck('id')->all());
        DB::table('members')->where('gender', 'Female')->delete();
        $this->assertCount(8, app(HomepageProfiles::class)->get());
    }
}
