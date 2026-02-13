<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $projects = Project::all();

        Activity::factory(20)->sequence(
            fn () => [
                'user_id' => ($user = $users->random())->id,
                'project_id' => fake()->optional(0.7)->randomElement(
                    $projects->where('user_id', $user->id)->pluck('id')->toArray() ?: [null]
                ),
            ]
        )->create();
    }
}
