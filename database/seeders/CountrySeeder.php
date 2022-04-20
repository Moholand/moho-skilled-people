<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 100 countries and foreach country 1 user created
        // for each user one role added
        // for each user with candidate role, one candidates table row created
        // for each user with employer role, one employer table and employer_user table row created
        for($i=1; $i<=100; $i++) {
            $country = \App\Models\Country::factory()->create();

            $user = \App\Models\User::factory()->create([
                'country_id' => $country->id
            ]);

            DB::table('role_user')->insert([
                'role_id' => $role_id = random_int(1, 3),
                'user_id' => $user->id
            ]);

            if($role_id === Role::CANDIDATE_ROLE_ID) {
                \App\Models\Candidate::factory()->create([
                    'user_id' => $user->id
                ]);
            }

            if($role_id === Role::EMPLOYER_ROLE_ID) {
                $employer = \App\Models\Employer::factory()->create();

                DB::table('employer_user')->insert([
                    'employer_id' => $employer->id,
                    'user_id' => $user->id
                ]);
            }
        }
    }
}
