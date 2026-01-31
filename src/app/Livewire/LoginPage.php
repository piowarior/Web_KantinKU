<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LoginPage extends Component
{
    public $email, $password;

    public function login()
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            session()->regenerate();

            logger(auth()->user()->getRoleNames());

            if (auth()->user()->hasRole('Super Admin')) {
                return redirect('/admin'); // atau /dashboard jika itu dashboard admin
            }

            return redirect('/'); // redirect ke halaman web biasa
        }


        $this->addError('email', 'Email atau password salah.');
    }

    public function render()
    {
        return view('livewire.login-page');
    }
}
