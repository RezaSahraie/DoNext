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

        $categories = Category::factory()->count(3)->create([
            'user_id' => $user->id,
        ]);

        foreach ($categories as $category) {
            Task::factory()->count(5)->create([
                'user_id' => $user->id,
                'category_id' => $category->id,
            ]);
        }

        Task::factory()->count(3)->create([
            'user_id' => $user->id,
            'category_id' => null,
        ]);
    }
}
