<?php

namespace App\Livewire\Auth;

use App\Services\SmsService;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.auth')]
class ResetPassword extends Component
{
    public string $phone_number = '';

    public string $otp_code = '';

    public string $password = '';

    public string $password_confirmation = '';

    /**
     * Reset the password for the given user.
     */
    public function resetPassword(): void
    {
        $this->validate([
            'phone_number' => ['required', 'string', 'regex:/^\+[1-9]\d{1,14}$/'],
            'otp_code' => ['required', 'string', 'size:6'],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        try {
            $smsService = app(SmsService::class);
            $verified = $smsService->verifyOtp($this->phone_number, $this->otp_code, 'password_reset');

            if (!$verified) {
                $this->addError('otp_code', __('Invalid or expired OTP code.'));
                return;
            }

            // Find user by phone number
            $user = \App\Models\User::where('phone_number', $this->phone_number)->first();

            if (!$user) {
                $this->addError('phone_number', __('No account found with this phone number.'));
                return;
            }

            // Update password
            $user->forceFill([
                'password' => Hash::make($this->password),
            ])->save();

            event(new PasswordReset($user));

            Session::flash('status', __('Your password has been reset successfully.'));

            $this->redirectRoute('login', navigate: true);

        } catch (\Exception $e) {
            $this->addError('otp_code', __('Unable to reset password. Please try again.'));
        }
    }
}
