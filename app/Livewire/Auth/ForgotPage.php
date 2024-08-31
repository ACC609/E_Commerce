<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Title;
use Livewire\Component;

use function Laravel\Prompts\password;

#[Title('Recuperação')]
class ForgotPage extends Component
{
    public $email;
    public function save()
    {
        $this->validate([
            'email' => 'required|max:200|exists:users,email'
        ]);
        $status = Password::sendResetLink(['email' => $this->email]);

        if ($status === Password::RESET_LINK_SENT) {
            session()->flash('success', 'Foi enviado um link de restauração no seu email');
            $this->email = '';
        }
    }
    public function render()
    {
        return view('livewire.auth.forgot-page');
    }
}
