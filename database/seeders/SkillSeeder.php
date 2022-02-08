<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $levels = ['basic', 'intermediate', 'advance'];

        // Create 100 skills and foreach skill fill 1 skill_user table row
        for($i=1; $i<=100; $i++) {
            $skill = \App\Models\Skill::factory()->create();

            DB::table('skill_user')->insert([
                'skill_id' => $skill->id,
                'user_id' => random_int(1, 100),
                'level' => $levels[array_rand($levels)]
            ]);
        }
    }
}
