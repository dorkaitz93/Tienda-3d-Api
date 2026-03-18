<?php

namespace Database\Factories;

use App\Models\albisteak;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\albisteak>
 */
class albisteakFactory extends Factory
{
    protected $model = Albisteak::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'izenburua' => $this->faker->word(),
            'laburpena' => $this->faker->word(),
            'xehetasunak' => $this->faker->word(),
        // 'irakurketak' => $this->faker->randomNumber(2),
        // 'prezioa'     => $this->faker->randomFloat(2, 0, 999),
        ];
    }
}
