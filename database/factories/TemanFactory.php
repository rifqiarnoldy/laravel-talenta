<?php

namespace Database\Factories;

use App\Models\Teman;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Teman>
 */
class TemanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Teman::class;

    public function definition(): array
    {
        return [
            //
            'name'          => $this->faker->name(),
            'jenis_kelamin' => $this->faker->randomElement(['laki-laki', 'perempuan']),
            'usia'          => $this->faker->numberBetween(13, 35),
        ];
    }
}
