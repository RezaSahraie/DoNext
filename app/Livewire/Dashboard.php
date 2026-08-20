<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class Dashboard extends Component
{
    public function render()
    {
        /** @var User $user */
        $user = Auth::user();

        $totalTasks = $user->tasks()->count();
        $completedTasks = $user->tasks()->where('status', 'completed')->count();

        // due_date is a datetime in the database, so use whereDate instead of
        // comparing the whole value with today's midnight.
        $todayTasks = $user->tasks()->whereDate('due_date', today())->count();

        $completionRate = $totalTasks > 0
            ? round(($completedTasks / $totalTasks) * 100, 2)
            : 0;

        $todaysTaskList = $user->tasks()
            ->whereDate('due_date', today())
            ->with('category')
            ->orderByRaw("CASE WHEN status = 'completed' THEN 1 ELSE 0 END")
            ->orderByRaw("CASE
                WHEN priority = 'high' THEN 1
                WHEN priority = 'medium' THEN 2
                WHEN priority = 'low' THEN 3
                ELSE 4
            END")
            ->orderBy('due_date')
            ->get();

        $todayRemaining = $user->tasks()
            ->whereDate('due_date', today())
            ->where('status', '!=', 'completed')
            ->count();

        $upcomingTasks = $user->tasks()
            ->where('status', '!=', 'completed')
            ->whereDate('due_date', '>', today())
            ->whereNotNull('due_date')
            ->with('category')
            ->orderBy('due_date')
            ->orderByRaw("CASE
                WHEN priority = 'high' THEN 1
                WHEN priority = 'medium' THEN 2
                WHEN priority = 'low' THEN 3
                ELSE 4
            END")
            ->limit(3)
            ->get();

        $weekStart = now()->startOfWeek();
        $weekEnd = now()->endOfWeek();

        $weeklyTotal = $user->tasks()
            ->whereNotNull('due_date')
            ->whereBetween('due_date', [$weekStart, $weekEnd])
            ->count();

        $weeklyCompleted = $user->tasks()
            ->whereNotNull('due_date')
            ->whereBetween('due_date', [$weekStart, $weekEnd])
            ->where('status', 'completed')
            ->count();

        $weeklyRate = $weeklyTotal > 0
            ? (int) round(($weeklyCompleted / $weeklyTotal) * 100)
            : 0;

        $weeklyBars = [];
        for ($i = 0; $i < 7; $i++) {
            $day = $weekStart->copy()->addDays($i);

            $weeklyBars[] = $user->tasks()
                ->whereDate('completed_at', $day)
                ->where('status', 'completed')
                ->count();
        }

        $maxBar = max($weeklyBars) > 0 ? max($weeklyBars) : 1;

        return view('livewire.dashboard', [
            'user' => $user,
            'totalTasks' => $totalTasks,
            'completedTasks' => $completedTasks,
            'todayTasks' => $todayTasks,
            'completionRate' => $completionRate,
            'todaysTaskList' => $todaysTaskList,
            'todayRemaining' => $todayRemaining,
            'upcomingTasks' => $upcomingTasks,
            'weeklyTotal' => $weeklyTotal,
            'weeklyCompleted' => $weeklyCompleted,
            'weeklyRate' => $weeklyRate,
            'weeklyBars' => $weeklyBars,
            'maxBar' => $maxBar,
        ]);
    }
}
