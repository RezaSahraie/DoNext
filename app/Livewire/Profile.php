<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class Profile extends Component
{
    /**
     * =====================
     * properties
     * =====================
     */
    public string $name = '';
    public string $email = '';

    /**
     * =====================
     * Mount
     * =====================
     * Runs once when the component is first loaded.
     * We load the authenticated user's data here.
     */
    public function mount(): void
    {
        /** @var User $user */
        $user = Auth::user();

        $this->name = $user->name;
        $this->email = $user->email;
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

        // Real task statistics from database
        $totalTasks = $user->tasks()->count();
        $completedTasks = $user->tasks()->where('status', 'completed')->count();

        $completionRate = $totalTasks > 0 ? (int) round(($completedTasks / $totalTasks) * 100) : 0;

        return view('livewire.profile', [
            'user' => $user,
            'totalTasks' => $totalTasks,
            'completedTasks' => $completedTasks,
            'completionRate' => $completionRate,
        ]);
    }
}