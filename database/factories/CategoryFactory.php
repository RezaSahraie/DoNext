<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'name' => fake()->words(2, true),
            'color' => fake()->randomElement([
                '#6366F1', '#3B82F6', '#8B5CF6', '#EC4899', '#EF4444',
                '#F97316', '#F59E0B', '#10B981', '#06B6D4',
            ]),
            'icon' => fake()->randomElement([
                'folder', 'work', 'study', 'personal', 'other',
            ]),
        ];
    }
}
