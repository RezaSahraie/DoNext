<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DoNextSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Skip seeding if data already exists (makes db:seed idempotent)
        if (User::where('email', 'test@donext.test')->exists()) {
            return;
        }

        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@donext.test',
            'password' => Hash::make('12345678'),
        ]);

        $categories = collect(['Work', 'Learning', 'Personal'])
            ->map(fn (string $name) => Category::factory()->create([
                'user_id' => $user->id,
                'name' => $name,
                
            ]));

        foreach ($categories as $category) {
            Task::factory()
                ->pending()
                ->count(2)
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
