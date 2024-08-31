<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Login')]
class Login extends Component
{
    public $email;
    public $password;
    public function save()
    {
        $this->validate([
            'email' => 'required|email|max:200|exists:users,email',
            'password' => 'required|min:8',
        ]);
        if (!Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            session()->flash('error', 'Credenciais não encontradas');
            return;
        }

        return redirect()->intended();
    }
    public function render()
    {
        return view('livewire.auth.login');
    }
}
