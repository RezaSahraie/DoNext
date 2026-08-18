<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
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

    public bool $editMode = false;

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
     * ===============
     * Open Edit Mode
     * ===============
     */
    public function openEdit() : void {
        /** @var User $user */
        $user = Auth::user();

        // Refresh values from database before editing
        $this->name = $user->name;
        $this->email = $user->email;

        $this->resetValidation();
        $this->editMode = true;
    }

    /**
     * ================
     * Cancel Edit Mode
     * ================
     */
    public function cancelEdit() : void {
        /** @var User $user */
        $user = Auth::user();

        // Restore original values
        $this->name = $user->name;
        $this->email = $user->email;

        $this->resetValidation();
        $this->editMode = false;
    }

    /**
     * ==============
     * Update Profile
     * ==============
     */
    public function updateProfile() : void {
        /** @var User $user */
        $user = Auth::user();
        //validating information
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 
            // Allow keeping the same email, but block other users' emails
            Rule::unique('users', 'email')->ignore($user->id)],
        ]);

        //udating information
        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        $editMode = false;

        session()->flash('success', 'Profile updated successfully.');
        $this->dispatch('toast',
            type: 'success',
            message: 'Profile updated successfully.');
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