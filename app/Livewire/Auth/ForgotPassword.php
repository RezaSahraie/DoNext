<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;


#[Layout('layouts.auth')]
#[Title('Forgot Password - DoNext')]
class ForgotPassword extends Component
{

    public string $email = '';

    public function sendResetLink() : void {
        $this->validate([
            'email' => ['string', 'email', 'required'],
        ]);

        $status = Password::sendResetLink([
            'email' => $this->email,
        ]);

        if ($status !== Password::RESET_LINK_SENT) {
            $this->addError('email', __($status));

            return ;
        }

        session()->flash('status', __($status));

    }
    public function render()
    {
        return view('livewire.auth.forgot-password');
    }
}
