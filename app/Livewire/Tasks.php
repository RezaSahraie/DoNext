<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

#[Layout('layouts.app')]
class Tasks extends Component
{
    public string $title = '';
    public string $description = '';
    public string $priority = 'medium';
    public ?string $due_date = null;
    public ?int $category_id = null;

    public ?int $editingTaskId = null;
    public string $editTitle = '';
    public string $editDescription = '';
    public string $editPriority = 'medium';
    public ?string $editDueDate = null;
    public ?int $editCategoryId = null;

    public string $search = '';
    public string $filter = 'all';

    private function categoryRule()
    {
        return Rule::exists('categories', 'id')->where(fn ($query) =>
            $query->where('user_id', Auth::id())
        );
    }

    public function createTask(): void
    {
        $validated = $this->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'priority' => ['required', 'in:low,medium,high'],
            'due_date' => ['nullable', 'date'],
            'category_id' => ['nullable', 'integer', $this->categoryRule()],
        ]);

        Task::create([
            'user_id' => Auth::id(),
            'title' => $validated['title'],
            'description' => $validated['description'],
            'priority' => $validated['priority'],
            'due_date' => $validated['due_date'],
            'status' => 'pending',
            'category_id' => $validated['category_id'],
        ]);

        $this->reset(['title', 'description', 'due_date', 'category_id']);
        $this->priority = 'medium';

        $this->dispatch('task-created');
        $this->dispatch('toast', type: 'success', message: 'Task created successfully.');
    }

    public function toggleTask(int $taskId): void
    {
        $task = Task::whereKey($taskId)->where('user_id', Auth::id())->firstOrFail();

        if ($task->status === 'completed') {
            $task->update(['status' => 'pending', 'completed_at' => null]);
            $this->dispatch('toast', type: 'success', message: 'Task marked as pending.');
            return;
        }

        $task->update(['status' => 'completed', 'completed_at' => now()]);
        $this->dispatch('toast', type: 'success', message: 'Task completed successfully.');
    }

    #[On('delete-task')]
    public function confirmDeleteTask(int $taskId): void
    {
        $this->deleteTask($taskId);
    }

    public function deleteTask(int $taskId): void
    {
        $task = Task::whereKey($taskId)->where('user_id', Auth::id())->firstOrFail();
        $task->delete();
        $this->dispatch('toast', type: 'success', message: 'Task deleted successfully.');
    }

    public function editTask(int $taskId): void
    {
        $task = Task::whereKey($taskId)->where('user_id', Auth::id())->firstOrFail();

        $this->editingTaskId = $task->id;
        $this->editTitle = $task->title;
        $this->editDescription = $task->description ?? '';
        $this->editPriority = $task->priority ?: 'medium';
        $this->editDueDate = $task->due_date?->format('Y-m-d');
        $this->editCategoryId = $task->category_id;

        $this->resetValidation();
        $this->dispatch('open-edit-task-modal');
    }

    public function updateTask(): void
    {
        $validated = $this->validate([
            'editTitle' => ['required', 'string', 'max:255'],
            'editDescription' => ['nullable', 'string'],
            'editPriority' => ['required', 'in:low,medium,high'],
            'editDueDate' => ['nullable', 'date'],
            'editCategoryId' => ['nullable', 'integer', $this->categoryRule()],
        ]);

        $task = Task::whereKey($this->editingTaskId)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $task->update([
            'title' => $validated['editTitle'],
            'description' => $validated['editDescription'],
            'priority' => $validated['editPriority'],
            'due_date' => $validated['editDueDate'],
            'category_id' => $validated['editCategoryId'],
        ]);

        $this->reset([
            'editingTaskId',
            'editTitle',
            'editDescription',
            'editDueDate',
            'editCategoryId',
        ]);
        $this->editPriority = 'medium';

        $this->dispatch('close-edit-task-modal');
        $this->dispatch('toast', type: 'success', message: 'Task updated successfully.');
    }

    public function updatedSearch(): void
    {
        // Reset pagination/filter UI state when search changes if pagination is added later.
        $this->resetValidation();
    }

    public function render()
    {
        $query = Task::query()
            ->where('user_id', Auth::id())
            ->with('category');

        if ($this->search !== '') {
            $query->where(function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%')
                    ->orWhere('description', 'like', '%' . $this->search . '%');
            });
        }

        match ($this->filter) {
            'pending', 'completed' => $query->where('status', $this->filter),
            'today' => $query->whereDate('due_date', today()),
            default => null,
        };

        $tasks = $query
            ->orderByRaw("CASE WHEN status = 'completed' THEN 1 ELSE 0 END")
            ->orderByRaw("CASE
                WHEN priority = 'high' THEN 1
                WHEN priority = 'medium' THEN 2
                WHEN priority = 'low' THEN 3
                ELSE 4
            END")
            ->orderBy('due_date')
            ->get();

        $categories = Category::where('user_id', Auth::id())->orderBy('name')->get();

        return view('livewire.tasks', compact('tasks', 'categories'));
    }
}
