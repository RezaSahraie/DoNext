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
    public string $title = '';
    public string $description = '';
    public string $priority = 'medium';
    public ?string $due_date = null;

    public function createTask(): void
    {
        $this->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'priority' => ['required', 'in:low,medium,high'],
            'due_date' => ['nullable', 'date'],
        ]);

        Task::create([
            'user_id' => Auth::id(),
            'title' => $this->title,
            'description' => $this->description,
            'priority' => $this->priority,
            'due_date' => $this->due_date,
            'status' => 'pending',
        ]);

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

    public function toggleTask(int $taskId): void
    {
        $task = Task::where('id', $taskId)->where('user_id', Auth::id())->firstOrFail();

        if ($task->status === 'completed') {
            $task->update([
                'status' => 'pending',
                'completed_at' => null,
            ]);

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
        $task = Task::where('id', $taskId)->where('user_id', Auth::id())->firstOrFail();

        $task->delete();

        $this->dispatch('toast', type: 'success', message: 'Task deleted successfully.');
    }

    public function render()
    {
        $tasks = Task::where('user_id', Auth::id())
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
