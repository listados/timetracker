<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'name' => fake()->randomElement([
                'Sistema Financeiro',
                'App Mobile',
                'API de Pagamentos',
                'Dashboard Analytics',
                'Portal do Cliente',
                'E-commerce',
                'CRM Interno',
                'Sistema de RH',
            ]),
            'description' => fake()->optional(0.7)->sentence(),
            'color' => fake()->hexColor(),
            'is_active' => true,
        ];
    }

    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => false,
        ]);
    }
}
