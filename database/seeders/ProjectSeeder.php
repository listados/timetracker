<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();

        Project::factory(5)->sequence(
            fn () => ['user_id' => $users->random()->id]
        )->create();
    }
}
