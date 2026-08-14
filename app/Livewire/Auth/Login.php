<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.auth')]
#[Title('Login — DoNext')]
class Login extends Component
{
    public string $email = '';
    public string $password = '';
    public bool $remember = false;

    public function login() : void {
        $credentials = $this->validate([
            'email' =>['required', 'email'],
            'password' => ['required', 'string',]
        ]);

        if (!Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']],
        $this->remember)) {
            $this->addError('email', 'The provided credentials are incorrect.');
            return;
        }

        session()->regenerate();
        $this->redirectRoute('dashboard');
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
