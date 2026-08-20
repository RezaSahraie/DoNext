<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class Categories extends Component
{
    public string $name = '';
    public string $color = '#6366F1';
    public string $icon = 'folder';

    public ?int $editCategoryId = null;
    public string $editName = '';
    public string $editColor = '';
    public string $editIcon = '';

    public ?int $selectedCategoryId = null;
    public ?int $deleteCategoryId = null;

    public array $colorOptions = [
        '#6366F1', '#3B82F6', '#8B5CF6', '#EC4899', '#EF4444',
        '#F97316', '#F59E0B', '#10B981', '#06B6D4',
    ];

    public function createCategory(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'color' => ['required', 'string', 'regex:/^#[0-9A-Fa-f]{6}$/'],
            'icon' => ['required', 'string', 'max:50'],
        ]);

        Category::create([
            'user_id' => Auth::id(),
            'name' => $validated['name'],
            'color' => $validated['color'],
            'icon' => $validated['icon'],
        ]);

        $this->reset(['name']);
        $this->color = '#6366F1';
        $this->icon = 'folder';

        $this->dispatch('toast', type: 'success', message: 'Category created successfully');
        $this->dispatch('category-created');
    }

    public function editCategory(int $categoryId): void
    {
        $category = Category::where('user_id', Auth::id())->findOrFail($categoryId);

        $this->editCategoryId = $category->id;
        $this->editName = $category->name;
        $this->editColor = $category->color;
        $this->editIcon = $category->icon;
        $this->resetValidation();

        $this->dispatch('open-edit-category-modal');
    }

    public function updateCategory(): void
    {
        $validated = $this->validate([
            'editName' => ['required', 'string', 'max:255'],
            'editColor' => ['required', 'string', 'regex:/^#[0-9A-Fa-f]{6}$/'],
            'editIcon' => ['required', 'string', 'max:50'],
        ]);

        $category = Category::where('user_id', Auth::id())->findOrFail($this->editCategoryId);
        $category->update([
            'name' => $validated['editName'],
            'color' => $validated['editColor'],
            'icon' => $validated['editIcon'],
        ]);

        $this->reset(['editCategoryId', 'editName', 'editColor', 'editIcon']);
        $this->dispatch('close-edit-category-modal');
        $this->dispatch('toast', type: 'success', message: 'Category updated successfully');
    }

    public function deleteCategory(int $categoryId): void
    {
        $category = Category::where('user_id', Auth::id())->findOrFail($categoryId);
        $category->delete();

        if ($this->selectedCategoryId === $category->id) {
            $this->selectedCategoryId = null;
        }

        $this->deleteCategoryId = null;
        $this->dispatch('toast', type: 'success', message: 'Category deleted successfully');
    }

    public function selectCategory(int $categoryId): void
    {
        Category::where('user_id', Auth::id())->findOrFail($categoryId);
        $this->selectedCategoryId = $this->selectedCategoryId === $categoryId ? null : $categoryId;
    }

    public function render()
    {
        $categories = Category::where('user_id', Auth::id())
            ->withCount('tasks')
            ->latest()
            ->get();

        $categoryTasks = collect();

        if ($this->selectedCategoryId) {
            $categoryTasks = Task::where('user_id', Auth::id())
                ->where('category_id', $this->selectedCategoryId)
                ->orderByRaw("CASE WHEN status = 'completed' THEN 1 ELSE 0 END")
                ->orderByRaw("CASE WHEN due_date IS NULL THEN 1 ELSE 0 END")
                ->orderBy('due_date')
                ->get();
        }

        return view('livewire.categories-v2', compact('categories', 'categoryTasks'));
    }
}
