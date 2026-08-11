<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class Register extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Register new User
     */

    #[Layout('layouts.auth')]
    #[Title('Register — DoNext')]
    public function register() : void {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],

            'email' => ['required', 'unique:users,email', 'string', 'email', 'max:255'],

            'password' => ['required', 'confirmed', 'string', 'min:8'],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);
        Auth::login($user);

        session()->regenerate();
        $this->redirectRoute('dashboard');
    }
    

    public function render()
    {
        return view('livewire.auth.register');
    }
}
