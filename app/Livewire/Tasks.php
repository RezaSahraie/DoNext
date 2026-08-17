<?php

namespace App\Livewire;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

#[Layout('layouts.app')]
class Tasks extends Component
{
    /**
     * ======================
     * properties
     * ======================
     */
    public string $title = '';
    public string $description = '';
    public string $priority = 'medium';
    public ?string $due_date = null;

    public ?int $editingTaskId = null;

    public string $editTitle = '';
    public string $editDescription = '';
    public string $editPriority = 'medium';
    public ?string $editDueDate = null;
    public ?int $editCategoryId = null;

    public string $search = '';
    public string $filter = 'all';

    /**
     * =====================
     * Create Task
     * =====================
     */

    public function createTask(): void
    {
        //validating inputs
        $this->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'priority' => ['required', 'in:low,medium,high'],
            'due_date' => ['nullable', 'date'],
        ]);
        //Creating task
        Task::create([
            'user_id' => Auth::id(),
            'title' => $this->title,
            'description' => $this->description,
            'priority' => $this->priority,
            'due_date' => $this->due_date,
            'status' => 'pending',
        ]);
        //reseting inputs
        $this->reset([
            'title',
            'description',
            'due_date',
        ]);

        $this->priority = 'medium';

        $this->dispatch('task-created');
        $this->dispatch(
            'toast',
            type: 'success',
            message: 'Task created successfully.'
        );
        session()->flash('success', 'Task created successfully.');
    }

    /**
     * ==================
     * Changing status of Task
     * ==================
     */
    public function toggleTask(int $taskId): void
    {
        //finding task
        $task = Task::where('id', $taskId)->where('user_id', Auth::id())->firstOrFail();

        if ($task->status === 'completed') {
            //changing completed status to pending status
            $task->update([
                'status' => 'pending',
                'completed_at' => null,
            ]);

            $this->dispatch('toast', type: 'success', message: 'Task marked as pending.');

            return;
        }
        //changing pending status to completed status
        $task->update(['status' => 'completed', 'completed_at' => now()]);
        $this->dispatch('toast', type: 'success', message: 'Task completed successfully.');
    }

    /**
     * ================
     * Deleting Task
     * ================
     */
    #[On('delete-task')]
    public function confirmDeleteTask(int $taskId): void
    {
        $this->deleteTask($taskId);
    }

    public function deleteTask(int $taskId): void
    {
        $task = Task::where('id', $taskId)->where('user_id', Auth::id())->firstOrFail();

        $task->delete();

        $this->dispatch('toast', type: 'success', message: 'Task deleted successfully.');
    }

    /**
     * ===============
     * finding Task for edit form
     * ===============
     */
    public function editTask(int $taskId): void
    {

        $task = Task::where('user_id', Auth::id())
            ->findOrFail($taskId);

        $this->editingTaskId = $task->id;
        $this->editTitle = $task->title;
        $this->editDescription = $task->description ?? '';
        $this->editPriority = $task->priority;
        $this->editDueDate = $task->due_date?->format('Y-m-d');
        $this->editCategoryId = $task->category_id;

        $this->dispatch('open-edit-task-modal');
    }

    /**
     * =================
     * Editing Task
     * =================
     */
    public function updateTask(): void
    {
        //validating inputs
        $this->validate([
            'editTitle' => ['required', 'string', 'max:255'],
            'editDescription' => ['nullable', 'string'],
            'editPriority' => ['required', 'in:low,medium,high'],
            'editDueDate' => ['nullable', 'date'],
            'editCategoryId' => ['nullable', 'integer', 'exists:categories,id'],
        ]);
        //finding task
        $task = Task::where('user_id', Auth::id())
            ->findOrFail($this->editingTaskId);
        //updating task & saving new data
        $task->update([
            'title' => $this->editTitle,
            'description' => $this->editDescription,
            'priority' => $this->editPriority,
            'due_date' => $this->editDueDate,
            'category_id' => $this->editCategoryId,
        ]);
        //reseting inputs
        $this->reset([
            'editingTaskId',
            'editTitle',
            'editDescription',
            'editDueDate',
            'editCategoryId',
        ]);

        $this->editPriority = 'medium';

        $this->dispatch('close-edit-task-modal');

        $this->dispatch('toast', [
            'message' => 'Task updated successfully.',
            'type' => 'success',
        ]);
    }

    /**
     * ==============
     * render
     * ==============
     */
    public function render()
    {
        //Creating query of user's tasks
        $query = Task::query()->where('user_id', Auth::id())->with('category');

        //search
        if ($this->search !== '') {
            $query->where(function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%')
                    ->orWhere('description', 'like', '%' . $this->search . '%');
            });
        }

        // Filter
        match ($this->filter) {
            'pending', 'completed' => $query->where('status', $this->filter),
            'today' => $query->whereDate('due_date', today()),
            default => null,
        };

        //finding tasks of user & sorting by status,priority and due_date
        $tasks = $query
            ->orderByRaw("
        CASE
            WHEN status = 'completed' THEN 1
            ELSE 0
        END
        ")
            ->orderByRaw("
        CASE
            WHEN priority = 'high' THEN 1
            WHEN priority = 'medium' THEN 2
            WHEN priority = 'low' THEN 3
            ELSE 4
        END
        ")->orderBy('due_date', 'asc')->get();

        return view('livewire.tasks', [
            'tasks' => $tasks,
        ]);
    }
}
