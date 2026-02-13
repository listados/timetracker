<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Activity>
 */
class ActivityFactory extends Factory
{
    public function definition(): array
    {
        $startedAt = fake()->dateTimeBetween('-30 days', 'now');
        $endedAt = (clone $startedAt)->modify('+' . fake()->numberBetween(15, 480) . ' minutes');
        $durationMinutes = (int) (($endedAt->getTimestamp() - $startedAt->getTimestamp()) / 60);

        return [
            'user_id' => User::factory(),
            'project_id' => null,
            'title' => fake()->randomElement([
                'Implementar autenticação',
                'Corrigir bug no formulário',
                'Criar testes unitários',
                'Refatorar service layer',
                'Code review PR #42',
                'Deploy em produção',
                'Reunião de sprint planning',
                'Documentar API',
                'Configurar CI/CD',
                'Otimizar queries SQL',
                'Criar migration de dados',
                'Integrar gateway de pagamento',
                'Ajustar layout responsivo',
                'Configurar monitoramento',
                'Resolver merge conflicts',
            ]),
            'description' => fake()->optional(0.5)->paragraph(),
            'started_at' => $startedAt,
            'ended_at' => $endedAt,
            'duration_minutes' => $durationMinutes,
            'github_link' => fake()->optional(0.3)->url(),
            'todoist_link' => fake()->optional(0.2)->url(),
            'other_links' => fake()->optional(0.1)->randomElement([
                ['figma' => 'https://figma.com/file/abc123'],
                ['jira' => 'https://jira.example.com/TASK-456'],
            ]),
        ];
    }

    public function running(): static
    {
        return $this->state(fn (array $attributes) => [
            'ended_at' => null,
            'duration_minutes' => null,
        ]);
    }
}
