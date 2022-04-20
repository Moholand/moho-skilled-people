<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EmployerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'company_name' => $company_name = $this->faker->company(),
            'slug' => Str::slug($company_name , "-"),
            'company_email' => $this->faker->email(),
            'company_address' => $this->faker->address()
        ];
    }
}
