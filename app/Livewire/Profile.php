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
    public string $name = '';
    public string $email = '';
    public bool $editMode = false;

    public function mount(): void
    {
        $this->loadUser();
    }

    private function loadUser(): void
    {
        /** @var User $user */
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;
    }

    public function openEdit(): void
    {
        $this->loadUser();
        $this->resetValidation();
        $this->editMode = true;
    }

    public function cancelEdit(): void
    {
        $this->loadUser();
        $this->resetValidation();
        $this->editMode = false;
    }

    public function updateProfile(): void
    {
        /** @var User $user */
        $user = Auth::user();

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
        ]);

        $user->update($validated);
        $this->loadUser();
        $this->editMode = false;

        $this->dispatch('toast', type: 'success', message: 'Profile updated successfully.');
    }

    public function render()
    {
        /** @var User $user */
        $user = Auth::user();

        $totalTasks = $user->tasks()->count();
        $completedTasks = $user->tasks()->where('status', 'completed')->count();
        $completionRate = $totalTasks > 0
            ? (int) round(($completedTasks / $totalTasks) * 100)
            : 0;

        return view('livewire.profile', [
            'user' => $user,
            'totalTasks' => $totalTasks,
            'completedTasks' => $completedTasks,
            'completionRate' => $completionRate,
        ]);
    }
}
