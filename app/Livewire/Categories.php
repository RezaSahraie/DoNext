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
    /**
     * ======================
     * properties
     * ======================
     */
    //Create
    public string $name = '';
    public string $color = '#6366F1';
    public string $icon = 'folder';
    //Edit
    public ?int $editCategoryId = null;
    public string $editName = '';
    public string $editColor = '';
    public string $editIcon = '';
    //Selected Category
    public ?int $selectedCategoryId = null;
    //Delete
    public ?int $deleteCategoryId = null;
    //Color Options
    public array $colorOptions = [
        '#6366F1',
        '#3B82F6',
        '#8B5CF6',
        '#EC4899',
        '#EF4444',
        '#F97316',
        '#F59E0B',
        '#10B981',
        '#06B6D4',
    ];


    
    /**
     * ======================
     * Create Category
     * ======================
     */
    public function createCategory(): void
    {
        $validated = $this->validate([
            'name' => ['required','string','max:255',],
            'color' => ['required','string','regex:/^#[0-9A-Fa-f]{6}$/',],
            'icon' => ['required','string','max:50',],
        ]);

        Category::create([
            'user_id' => Auth::id(),
            'name' => $validated['name'],
            'color' => $validated['color'],
            'icon' => $validated['icon'],
        ]);

        // Reset form
        $this->reset('name');

        $this->color = '#6366F1';
        $this->icon = 'folder';

        // Success message
        session()->flash('success','Category created successfully');

        // Toast
        $this->dispatch('toast',
            type: 'success',
            message: 'Category created successfully'
        );

        // Close create modal
        $this->dispatch('category-created');
    }

    /**
     * ======================
     * Edit Category
     * ======================
     */
    public function editCategory(int $categoryId): void
    {
        $category = Category::where('user_id', Auth::id())
            ->findOrFail($categoryId);

        $this->editCategoryId = $category->id;
        $this->editName = $category->name;
        $this->editColor = $category->color;
        $this->editIcon = $category->icon;

        $this->resetValidation();

        $this->dispatch('open-edit-category-modal');
    }

    /**
     * ======================
     * Update Category
     * ======================
     */
    public function updateCategory(): void
    {
        $validated = $this->validate([
            'editName' => ['required','string','max:255',],
            'editColor' => ['required','string','regex:/^#[0-9A-Fa-f]{6}$/',],
            'editIcon' => ['required','string','max:50',],
        ]);

        $category = Category::where('user_id', Auth::id())
            ->findOrFail($this->editCategoryId);

        $category->update([
            'name' => $validated['editName'],
            'color' => $validated['editColor'],
            'icon' => $validated['editIcon'],
        ]);

        // Reset edit fields
        $this->reset([
            'editCategoryId',
            'editName',
            'editColor',
            'editIcon',
        ]);

        // Success message
        session()->flash('success','Category edited successfully');

        // Close modal
        $this->dispatch('close-edit-category-modal');

        // Toast
        $this->dispatch('toast',
            type: 'success',
            message: 'Category edited successfully'
        );
    }


    /**
    *===========
    * Delete Category
    *===========
    */

    public function deleteCategory(int $categoryId): void
    {
        $category = Category::where('user_id', Auth::id())
            ->findOrFail($categoryId);

        $category->delete();

        // If deleted category was selected,
        // close its task section.
        if ($this->selectedCategoryId === $category->id) {
            $this->selectedCategoryId = null;
        }

        // Reset delete state
        $this->deleteCategoryId = null;

        // Success message
        session()->flash('success','Category deleted successfully');

        // Toast
        $this->dispatch('toast',
            type: 'success',
            message: 'Category deleted successfully'
        );
    }


    /*
    |===========
    | Select Category
    |===========
    */

    public function selectCategory(int $categoryId): void
    {
        $category = Category::where('user_id', Auth::id())
            ->findOrFail($categoryId);

        // If the same category is clicked again,
        // close the task list.
        if ($this->selectedCategoryId === $category->id) {
            $this->selectedCategoryId = null;

            return;
        }

        $this->selectedCategoryId = $category->id;
    }


    /*
    |===========
    | Render
    |===========
    */

    public function render()
    {
        
        //find categories
        $categories = Category::where('user_id',Auth::id())->withCount('tasks')->latest()->get();

        //Tasks of Selected Category
        $categoryTasks = collect();

        if ($this->selectedCategoryId) {

            $categoryTasks = Task::where('user_id',Auth::id())->where('category_id',$this->selectedCategoryId)->with('category')
                // Completed tasks go to the bottom.
                ->orderByRaw("CASE WHEN status = 'completed' THEN 1 ELSE 0 END")
                // Tasks without a due date go after
                // tasks that have a date.
                ->orderByRaw("CASE WHEN due_date IS NULL THEN 1 ELSE 0 END")
                // Earlier due dates first.
                ->orderBy('due_date')->get();
        }


        return view('livewire.categories', [
            'categories' => $categories,
            'categoryTasks' => $categoryTasks,
        ]);
    }
}