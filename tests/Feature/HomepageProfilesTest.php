<?php

namespace Tests\Feature;

use App\Services\HomepageProfiles;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class HomepageProfilesTest extends TestCase
{
    public function test_it_selects_the_latest_three_eligible_profiles_of_each_gender_in_alternating_order(): void
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
            for ($i = 0; $i < 4; $i++) {
                DB::table('members')->insert($base + ['gender' => $gender]);
            }
            foreach ([['active' => 'No'], ['member_type' => 'Free'], ['profile_hide' => 'Yes'], ['photo_approved' => 'No'], ['photo' => ' '], ['photo' => null]] as $invalid) {
                DB::table('members')->insert(array_replace($base + ['gender' => $gender], $invalid));
            }
        }
        $profiles = app(HomepageProfiles::class)->get();
        $this->assertSame(['Male', 'Female', 'Male', 'Female', 'Male', 'Female'], $profiles->pluck('gender')->all());
        $this->assertSame([4, 14, 3, 13, 2, 12], $profiles->pluck('id')->all());
        DB::table('members')->where('gender', 'Female')->delete();
        $this->assertCount(3, app(HomepageProfiles::class)->get());
    }
}
