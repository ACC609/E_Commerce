<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Cadastrar')]
class Register extends Component
{
    public $name;
    public $email;
    public $password;

    public function save()
    {
        //dd($this->name, $this->email, $this->password);
        $this->validate([
            'name' => 'required|max:200',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ]);
        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        Auth::login($user);
        return redirect()->route('home.index');
    }
    public function render()
    {
        return view('livewire.auth.register');
    }
}
