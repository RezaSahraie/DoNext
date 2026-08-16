<?php

namespace App\Livewire;

use App\Models\Task;
use Livewire\Attributes\Layout;
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
            'user_id' => auth()->id(),
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

    public function render()
    {
        return view('livewire.tasks', [
            'tasks' => Task::where('user_id', auth()->id())
                ->orderBy('due_date', 'asc')
                ->get(),
        ]);
    }
}
