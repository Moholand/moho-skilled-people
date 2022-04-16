<?php

namespace Database\Seeders;

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
        // Create 100 countries and foreach country create 1 user
        // for each user add one role
        for($i=1; $i<=100; $i++) {
            $country = \App\Models\Country::factory()->create();

            $user = \App\Models\User::factory()->create([
                'country_id' => $country->id
            ]);

            DB::table('role_user')->insert([
                'role_id' => random_int(1, 3),
                'user_id' => $user->id
            ]);
        }
    }
}
