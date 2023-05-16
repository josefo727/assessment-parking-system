<?php

namespace App\Services;

use Illuminate\Support\Arr;

class PhoneNumberService
{
    protected $countryCode = "+593";
    protected $mobilePrefixes = [96, 99, 98, 97, 95];

    /**
     * @return string
     */
    public function generatePhoneNumber(): string
    {
        $mobilePrefix = Arr::random($this->mobilePrefixes);
        $mobileNumber = random_int(1000000, 9999999);

        return $this->countryCode . $mobilePrefix . $mobileNumber;
    }

    /**
     * @return bool
     * @param mixed $phoneNumber
     */
    public function validatePhoneNumber($phoneNumber): bool
    {
        $pattern = '/^\+593(96|99|98|97|95)\d{7}$/';

        return (bool) preg_match($pattern, $phoneNumber);
    }
}
