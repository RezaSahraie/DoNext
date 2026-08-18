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

        //Total tasks of authenticated user.
        $totalTasks = $user->tasks()->count();
        //Completed tasks
        $completedTasks = $user->tasks()->where('status', 'completed')->count();
        //Tasks due today (any status)
        $todayTasks = $user->tasks()->where('due_date', today())->count();
        // Completion rate (avoid division by zero)
        $completionRate = $totalTasks > 0 ? round(($completedTasks/$totalTasks)*100, 2) : 0;

        // Real tasks due today (pending first, then by priority)
        $todaysTaskList = $user->tasks()->whereDate('due_date', today())->with('category')
            ->orderByRaw("CASE WHEN status = 'completed' THEN 1 ELSE 0 END")
            ->orderByRaw("
                CASE
                    WHEN priority = 'high' THEN 1
                    WHEN priority = 'medium' THEN 2
                    WHEN priority = 'low' THEN 3
                    ELSE 4
                END
            ")
            ->orderBy('due_date')
            ->get();

        // How many today tasks are still pending
        $todayRemaining = $user->tasks()
            ->whereDate('due_date', today())
            ->where('status', '!=', 'completed')
            ->count();

        // Upcoming tasks: due date after today, not completed
        $upcomingTasks = $user->tasks()
            ->where('status', '!=', 'completed')
            ->whereDate('due_date', '>', today())
            ->with('category')
            ->orderBy('due_date')
            ->orderByRaw("
                CASE
                    WHEN priority = 'high' THEN 1
                    WHEN priority = 'medium' THEN 2
                    WHEN priority = 'low' THEN 3
                    ELSE 4
                END
            ")
            ->limit(3)
            ->get();


        // Weekly progress (start of week = Monday)
        $weekStart = now()->startOfWeek();
        $weekEnd = now()->endOfWeek();

        $weeklyTotal = $user->tasks()
            ->whereBetween('due_date', [$weekStart, $weekEnd])
            ->count();

        $weeklyCompleted = $user->tasks()
            ->whereBetween('due_date', [$weekStart, $weekEnd])
            ->where('status', 'completed')
            ->count();

        $weeklyRate = $weeklyTotal > 0
            ? (int) round(($weeklyCompleted / $weeklyTotal) * 100)
            : 0;

        // Daily completed counts for the bar chart (Mon → Sun)
        $weeklyBars = [];
        for ($i = 0; $i < 7; $i++) {
            $day = $weekStart->copy()->addDays($i);

            $count = $user->tasks()
                ->whereDate('completed_at', $day)
                ->where('status', 'completed')
                ->count();

            $weeklyBars[] = $count;
        }

        $maxBar = max($weeklyBars) > 0 ? max($weeklyBars) : 1;

        return view('livewire.dashboard',[
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
