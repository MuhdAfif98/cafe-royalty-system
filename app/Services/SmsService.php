<?php

namespace App\Services;

use App\Models\OtpCode;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\Log;

class SmsService
{
    protected $client;
    protected $fromNumber;

    public function __construct()
    {
        $this->client = new Client(
            config('services.twilio.sid'),
            config('services.twilio.token')
        );
        $this->fromNumber = config('services.twilio.from');
    }

    public function sendOtp(string $phoneNumber, string $type = 'verification')
    {
        try {
            $otp = OtpCode::generate($phoneNumber, $type);

            $message = $this->getOtpMessage($otp->code, $type);

            $this->client->messages->create(
                $phoneNumber,
                [
                    'from' => $this->fromNumber,
                    'body' => $message
                ]
            );

            Log::info("OTP sent to {$phoneNumber} for {$type}");

            return $otp;
        } catch (\Exception $e) {
            Log::error("Failed to send OTP to {$phoneNumber}: " . $e->getMessage());
            throw $e;
        }
    }

    public function verifyOtp(string $phoneNumber, string $code, string $type = 'verification')
    {
        $otp = OtpCode::where('phone_number', $phoneNumber)
            ->where('code', $code)
            ->where('type', $type)
            ->where('used', false)
            ->where('expires_at', '>', now())
            ->first();

        if (!$otp) {
            return false;
        }

        $otp->markAsUsed();
        return true;
    }

    protected function getOtpMessage(string $code, string $type): string
    {
        switch ($type) {
            case 'verification':
                return "Your Coffee Shop Loyalty verification code is: {$code}. Valid for 10 minutes.";
            case 'password_reset':
                return "Your Coffee Shop Loyalty password reset code is: {$code}. Valid for 10 minutes.";
            default:
                return "Your Coffee Shop Loyalty code is: {$code}. Valid for 10 minutes.";
        }
    }

    public function sendPointsNotification(string $phoneNumber, int $points, float $amount)
    {
        try {
            $message = "You earned {$points} points for your \${$amount} purchase! Visit our app to check your balance.";

            $this->client->messages->create(
                $phoneNumber,
                [
                    'from' => $this->fromNumber,
                    'body' => $message
                ]
            );

            Log::info("Points notification sent to {$phoneNumber}");
        } catch (\Exception $e) {
            Log::error("Failed to send points notification to {$phoneNumber}: " . $e->getMessage());
        }
    }

    public function sendExpirationWarning(string $phoneNumber, int $points, string $expiryDate)
    {
        try {
            $message = "Your {$points} points will expire on {$expiryDate}. Visit our app to redeem them!";

            $this->client->messages->create(
                $phoneNumber,
                [
                    'from' => $this->fromNumber,
                    'body' => $message
                ]
            );

            Log::info("Expiration warning sent to {$phoneNumber}");
        } catch (\Exception $e) {
            Log::error("Failed to send expiration warning to {$phoneNumber}: " . $e->getMessage());
        }
    }
}
