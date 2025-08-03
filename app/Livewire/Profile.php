<?php

namespace App\Livewire;

use App\Services\SmsService;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class Profile extends Component
{
    public $name = '';
    public $email = '';
    public $phone_number = '';
    public $current_password = '';
    public $new_password = '';
    public $new_password_confirmation = '';
    public $otp_code = '';
    public $showOtpInput = false;
    public $processing = false;
    public $message = '';
    public $messageType = '';

    public function mount()
    {
        $user = auth()->user();
        if ($user) {
            $this->name = $user->name;
            $this->email = $user->email;
            $this->phone_number = $user->phone_number;
        }
    }

    public function updateProfile()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . auth()->id(),
            'phone_number' => 'required|string|max:20|unique:users,phone_number,' . auth()->id(),
        ]);

        $this->processing = true;
        $this->message = '';
        $this->messageType = '';

        try {
            $user = auth()->user();
            $user->update([
                'name' => $this->name,
                'email' => $this->email,
                'phone_number' => $this->phone_number,
            ]);

            $this->message = 'Profile updated successfully!';
            $this->messageType = 'success';
        } catch (\Exception $e) {
            $this->message = 'Failed to update profile: ' . $e->getMessage();
            $this->messageType = 'error';
        }

        $this->processing = false;
    }

    public function updatePassword()
    {
        $this->validate([
            'current_password' => 'required|current_password',
            'new_password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $this->processing = true;
        $this->message = '';
        $this->messageType = '';

        try {
            $user = auth()->user();
            $user->update([
                'password' => Hash::make($this->new_password),
            ]);

            $this->message = 'Password updated successfully!';
            $this->messageType = 'success';

            $this->current_password = '';
            $this->new_password = '';
            $this->new_password_confirmation = '';
        } catch (\Exception $e) {
            $this->message = 'Failed to update password: ' . $e->getMessage();
            $this->messageType = 'error';
        }

        $this->processing = false;
    }

    public function sendOtp()
    {
        $this->validate([
            'phone_number' => 'required|string|max:20',
        ]);

        $this->processing = true;
        $this->message = '';
        $this->messageType = '';

        try {
            $smsService = app(SmsService::class);
            $smsService->sendOtp($this->phone_number, 'verification');

            $this->showOtpInput = true;
            $this->message = 'OTP sent to your phone number!';
            $this->messageType = 'success';
        } catch (\Exception $e) {
            $this->message = 'Failed to send OTP: ' . $e->getMessage();
            $this->messageType = 'error';
        }

        $this->processing = false;
    }

    public function verifyOtp()
    {
        $this->validate([
            'otp_code' => 'required|string|size:6',
        ]);

        $this->processing = true;
        $this->message = '';
        $this->messageType = '';

        try {
            $smsService = app(SmsService::class);
            $verified = $smsService->verifyOtp($this->phone_number, $this->otp_code, 'verification');

            if ($verified) {
                $user = auth()->user();
                $user->update(['phone_verified' => true]);

                $this->message = 'Phone number verified successfully!';
                $this->messageType = 'success';
                $this->showOtpInput = false;
                $this->otp_code = '';
            } else {
                $this->message = 'Invalid OTP code. Please try again.';
                $this->messageType = 'error';
            }
        } catch (\Exception $e) {
            $this->message = 'Failed to verify OTP: ' . $e->getMessage();
            $this->messageType = 'error';
        }

        $this->processing = false;
    }

    public function render()
    {
        return view('livewire.profile')->layout('components.layouts.pwa');
    }
}
