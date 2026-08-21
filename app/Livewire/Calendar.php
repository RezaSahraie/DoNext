<?php

namespace App\Livewire;

use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class Calendar extends Component
{
    public int $year;
    public int $month;
    public ?string $selectedDate = null;

    public string $quickTitle = '';
    public string $quickDescription = '';
    public string $quickPriority = 'medium';

    public function mount(): void
    {
        $today = now();
        $this->year = (int) $today->year;
        $this->month = (int) $today->month;
        $this->selectedDate = $today->toDateString();
    }

    public function previousMonth(): void
    {
        $date = Carbon::create($this->year, $this->month, 1)->subMonth();
        $this->year = $date->year;
        $this->month = $date->month;

        // Keep selection inside the visible month.
        $this->selectedDate = $date->toDateString();
    }

    public function nextMonth(): void
    {
        $date = Carbon::create($this->year, $this->month, 1)->addMonth();
        $this->year = $date->year;
        $this->month = $date->month;
        $this->selectedDate = $date->toDateString();
    }

    public function goToToday(): void
    {
        $today = now();
        $this->year = $today->year;
        $this->month = $today->month;
        $this->selectedDate = $today->toDateString();
    }

    public function selectDate(string $date): void
    {
        $parsed = Carbon::createFromFormat('Y-m-d', $date);

        if ((int) $parsed->year !== $this->year || (int) $parsed->month !== $this->month) {
            return;
        }

        $this->selectedDate = $parsed->toDateString();
        $this->resetValidation();
    }

    public function toggleTask(int $taskId): void
    {
        $task = Task::query()
            ->whereKey($taskId)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        if ($task->status === 'completed') {
            $task->update([
                'status' => 'pending',
                'completed_at' => null,
            ]);

            $this->dispatch('toast', type: 'success', message: 'Task marked as pending.');
            return;
        }

        $task->update([
            'status' => 'completed',
            'completed_at' => now(),
        ]);

        $this->dispatch('toast', type: 'success', message: 'Task completed successfully.');
    }

    public function createTaskForSelectedDay(): void
    {
        $validated = $this->validate([
            'quickTitle' => ['required', 'string', 'max:255'],
            'quickDescription' => ['nullable', 'string'],
            'quickPriority' => ['required', 'in:low,medium,high'],
        ]);

        if (!$this->selectedDate) {
            return;
        }

        Task::create([
            'user_id' => Auth::id(),
            'title' => $validated['quickTitle'],
            'description' => $validated['quickDescription'],
            'priority' => $validated['quickPriority'],
            'due_date' => Carbon::createFromFormat('Y-m-d', $this->selectedDate)->startOfDay(),
            'status' => 'pending',
        ]);

        $this->reset(['quickTitle', 'quickDescription']);
        $this->quickPriority = 'medium';

        $this->dispatch('toast', type: 'success', message: 'Task created successfully.');
    }

    public function render()
    {
        /** @var User $user */
        $user = Auth::user();

        $startOfMonth = Carbon::create($this->year, $this->month, 1)->startOfDay();
        $endOfMonth = $startOfMonth->copy()->endOfMonth();

        $tasks = Task::query()
            ->where('user_id', $user->id)
            ->whereNotNull('due_date')
            ->whereBetween('due_date', [$startOfMonth, $endOfMonth])
            ->with('category')
            ->orderBy('due_date')
            ->get();

        $tasksByDate = $tasks->groupBy(fn (Task $task) => $task->due_date->toDateString());

        $startWeekday = $startOfMonth->dayOfWeekIso;
        $daysInMonth = $startOfMonth->daysInMonth;
        $cells = [];

        for ($i = 1; $i < $startWeekday; $i++) {
            $cells[] = null;
        }

        for ($day = 1; $day <= $daysInMonth; $day++) {
            $date = Carbon::create($this->year, $this->month, $day);
            $key = $date->toDateString();

            $cells[] = [
                'day' => $day,
                'date' => $key,
                'isToday' => $key === now()->toDateString(),
                'tasks' => $tasksByDate->get($key, collect()),
            ];
        }

        $selectedTasks = collect();
        if ($this->selectedDate) {
            $selectedTasks = Task::query()
                ->where('user_id', $user->id)
                ->whereDate('due_date', $this->selectedDate)
                ->with('category')
                ->orderByRaw("CASE WHEN status = 'completed' THEN 1 ELSE 0 END")
                ->orderBy('due_date')
                ->get();
        }

        $monthTitle = $startOfMonth->format('F Y');

        return view('livewire.calendar', compact('cells', 'monthTitle', 'selectedTasks'));
    }
}
