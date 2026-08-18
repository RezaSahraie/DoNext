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

        return view('livewire.dashboard',[
            'user' => $user,
            'totalTasks' => $totalTasks,
            'completedTasks' => $completedTasks,
            'todayTasks' => $todayTasks,
            'completionRate' => $completionRate,
            'todaysTaskList' => $todaysTaskList,
            'todayRemaining' => $todayRemaining,
        ]);
    }
}
