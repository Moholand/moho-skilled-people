<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

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
        for($i=1; $i<=100; $i++) {
            $country = \App\Models\Country::factory()->create();

            \App\Models\User::factory()->create([
                'country_id' => $country->id
            ]);
        }
    }
}
