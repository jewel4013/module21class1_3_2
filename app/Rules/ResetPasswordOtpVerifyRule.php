<?php

namespace App\Rules;

use App\Models\Otp;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class ResetPasswordOtpVerifyRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  Closure(string, ?string=): PotentiallyTranslatedString  $fail
     */
    public function __construct(protected string $email){}


    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $getOtp = Otp::where('email', $this->email)
        ->where('otp', $value)
        ->where('status', false)
        ->where('created_at', '>=', now()->subMinutes(60))
        ->first();

        if(!$getOtp){
            $fail('The OTP is not valid');
        }
    }
}
