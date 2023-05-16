<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Services\PhoneNumberService;

class ValidPhoneNumber implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        $phoneNumberService = new PhoneNumberService();

        return $phoneNumberService->validatePhoneNumber($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'El número de teléfono móvil no es válido.';
    }
}
