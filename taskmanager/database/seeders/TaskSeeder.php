<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Tag;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();
        $work = Category::where('slug', 'work')->first();
        $personal = Category::where('slug', 'personal')->first();

        $tasks = [
            [
                'category_id' => $work?->id,
                'title' => 'Prepare weekly project update',
                'description' => 'Summarize progress, blockers, and next steps.',
                'priority' => 'high',
                'status' => 'in_progress',
                'due_date' => now()->addDays(2)->toDateString(),
                'tags' => ['Client', 'Follow Up'],
            ],
            [
                'category_id' => $personal?->id,
                'title' => 'Plan grocery list',
                'description' => 'Check pantry and add essentials for the week.',
                'priority' => 'medium',
                'status' => 'pending',
                'due_date' => now()->addDays(5)->toDateString(),
                'tags' => ['Home', 'Planning'],
            ],
        ];

        foreach ($tasks as $taskData) {
            $tagNames = $taskData['tags'];
            unset($taskData['tags']);

            $task = Task::firstOrCreate(
                ['title' => $taskData['title']],
                array_merge($taskData, ['user_id' => $user?->id])
            );

            $task->tags()->sync(Tag::whereIn('name', $tagNames)->pluck('id'));
        }
    }
}
