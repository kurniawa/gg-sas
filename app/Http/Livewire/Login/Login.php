<?php

namespace App\Http\Livewire\Login;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public function render()
    {
        return view('livewire.login.login');
    }

    public function logout()
    {
        # code...
        Auth::logout();
        return redirect(route('login'))->with(['success_'=>'Anda telah logout dari sistem!']);
    }
}
