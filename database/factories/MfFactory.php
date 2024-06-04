<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mf>
 */
class MfFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $mang =['Toyota','Honda','Suzuki','BMW','Mitsubishi','VinFast','Mercedes-Benz','Huyndai','Mazda','Ford','Yamaha'];
        return [
            //định nghĩa Factory
            'mf_name' => fake()->unique()->randomElement($mang),
        ];
    }
}
