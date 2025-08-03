<?php

namespace App\Livewire\Auth;

use App\Services\SmsService;
use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.auth')]
class ForgotPassword extends Component
{
    public string $phone_number = '';

    /**
     * Send a password reset OTP to the provided phone number.
     */
    public function sendPasswordResetLink(): void
    {
        $this->validate([
            'phone_number' => ['required', 'string', 'regex:/^\+[1-9]\d{1,14}$/'],
        ]);

        try {
            $smsService = app(SmsService::class);
            $smsService->sendOtp($this->phone_number, 'password_reset');

            session()->flash('status', __('A password reset code has been sent to your phone number.'));
        } catch (\Exception $e) {
            session()->flash('status', __('Unable to send password reset code. Please try again.'));
        }
    }
}
