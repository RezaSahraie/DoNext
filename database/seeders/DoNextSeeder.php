<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Task;
use App\Models\User;
//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DoNextSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@donext.test'
        ]);

        $categories = collect(['Work', 'Learning', 'Personal'])
            ->map(function (string $name) use ($user) {
                return Category::factory()->create([
                    'user_id' => $user->id,
                    'name' => $name,
            ]);
        });
        

        foreach ($categories as $category) {
            Task::factory()
                ->pending()
                ->count(2)
                ->create([
                    'user_id' => $user->id,
                    'category_id' => $category->id,
            ]);

            Task::factory()
                ->inProgress()
                ->create([
                    'user_id' => $user->id,
                    'category_id' => $category->id,
            ]);

            Task::factory()
                ->completed()
                ->count(2)
                ->create([
                    'user_id' => $user->id,
                    'category_id' => $category->id,
            ]);
        }

        Task::factory()
            ->pending()
            ->count(3)
            ->create([
                'user_id' => $user->id,
                'category_id' => null,
        ]);
    }
}
