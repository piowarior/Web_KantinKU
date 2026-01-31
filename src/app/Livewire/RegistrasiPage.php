<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class RegistrasiPage extends Component
{
    public $name, $email, $password, $password_confirmation;

    public function submit()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|same:password_confirmation',
        ]);

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        // ✅ Tambahkan role default "user"
        $user->assignRole('user');

        return redirect()->route('login')->with('success', 'Registrasi berhasil!');
    }

    public function render()
    {
        return view('livewire.registrasi-page');
    }
}
