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
    /**
     * =====================
     * properties
     * =====================
     */
    public int $year;
    public int $month;

    /** Selected day as Y-m-d or null */
    public ?string $selectedDate = null;

    public string $quickTitle = '';
    public string $quickDescription = '';
    public string $quickPriority = 'medium';

    /**
     * =====================
     * Mount
     * =====================
     */
    public function mount(): void
    {
        $today = now();

        $this->year = (int) $today->year;
        $this->month = (int) $today->month;
        $this->selectedDate = $today->toDateString();
    }

    /**
     * =====================
     * Navigation
     * =====================
     */
    public function previousMonth(): void
    {
        $date = Carbon::create($this->year, $this->month, 1)->subMonth();

        $this->year = (int) $date->year;
        $this->month = (int) $date->month;
    }

    public function nextMonth(): void
    {
        $date = Carbon::create($this->year, $this->month, 1)->addMonth();

        $this->year = (int) $date->year;
        $this->month = (int) $date->month;
    }

    public function goToToday(): void
    {
        $today = now();

        $this->year = (int) $today->year;
        $this->month = (int) $today->month;
        $this->selectedDate = $today->toDateString();
    }

    public function selectDate(string $date): void
    {
        $this->selectedDate = $date;
    }

    /**
     * =====================
     * Toggle task status
     * =====================
     */
    public function toggleTask(int $taskId): void{
        $task = Task::query()->where('id', $taskId)->where('user_id', Auth::id())->firstOrFail();

        if($task->status === 'completed'){
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

    /**
     * =====================
     * Create task for selected day
     * =====================
     */
    public function createTaskForSelectedDay(): void
    {
        if (!$this->selectedDate) {
            return;
        }

        $validated = $this->validate([
            'quickTitle' => ['required', 'string', 'max:255'],
            'quickDescription' => ['nullable', 'string'],
            'quickPriority' => ['required', 'in:low,medium,high'],
        ]);

        Task::create([
            'user_id' => Auth::id(),
            'title' => $validated['quickTitle'],
            'description' => $validated['quickDescription'],
            'priority' => $validated['quickPriority'],
            'due_date' => $this->selectedDate,
            'status' => 'pending',
        ]);

        $this->reset(['quickTitle']);
        $this->quickPriority = 'medium';

        $this->dispatch(
            'toast',
            type: 'success',
            message: 'Task created successfully.'
        );
    }
    /**
     * =====================
     * Render
     * =====================
     */
    public function render()
    {
        /** @var User $user */
        $user = Auth::user();

        $startOfMonth = Carbon::create($this->year, $this->month, 1)->startOfDay();
        $endOfMonth = $startOfMonth->copy()->endOfMonth();

        // Tasks in this month for the authenticated user
        $tasks = Task::query()
            ->where('user_id', $user->id)
            ->whereNotNull('due_date')
            ->whereBetween('due_date', [$startOfMonth, $endOfMonth])
            ->with('category')
            ->orderBy('due_date')
            ->get();

        // Group tasks by date: ['2026-08-20' => Collection]
        $tasksByDate = $tasks->groupBy(function (Task $task) {
            return $task->due_date->format('Y-m-d');
        });

        // Build calendar cells (Monday-start week)
        // Carbon: dayOfWeekIso = 1 (Mon) ... 7 (Sun)
        $startWeekday = $startOfMonth->dayOfWeekIso; // 1-7
        $daysInMonth = $startOfMonth->daysInMonth;

        $cells = [];

        // Empty cells before day 1
        for ($i = 1; $i < $startWeekday; $i++) {
            $cells[] = null;
        }

        // Real days
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

        // Selected day tasks
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

        $monthTitle = $startOfMonth->translatedFormat('F Y');

        return view('livewire.calendar', [
            'cells' => $cells,
            'monthTitle' => $monthTitle,
            'selectedTasks' => $selectedTasks,
        ]);
    }
}