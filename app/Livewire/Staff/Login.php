<?php

namespace App\Livewire\Staff;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Login extends Component
{
    public $phone_number = '';
    public $password = '';
    public $message = '';
    public $messageType = '';

    public function login()
    {
        $this->validate([
            'phone_number' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::attempt(['phone_number' => $this->phone_number, 'password' => $this->password])) {
            $user = Auth::user();

            if ($user->isStaff()) {
                return redirect()->route('staff.dashboard');
            } else {
                Auth::logout();
                $this->message = 'Access denied. Staff login required.';
                $this->messageType = 'error';
            }
        } else {
            $this->message = 'Invalid credentials.';
            $this->messageType = 'error';
        }
    }

    public function render()
    {
        return view('livewire.staff.login')->layout('components.layouts.pwa');
    }
}
