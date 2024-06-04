<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        
        return [
            //Định nghĩa CarFactory            
            'description' => fake()->asciify('user-****'),
            'model' => fake()->regexify('[A-Z]{5}[0-4]{3}'),
            'produced_on' => now(),
            'image'=>'hinh'.rand(1,5).'.jpg',
            'mf_id'=>rand(1,10),
        ];
    }
}
