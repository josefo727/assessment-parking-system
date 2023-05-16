<?php

namespace App\Rules;

use App\Services\VehiclePlateService;
use Illuminate\Contracts\Validation\Rule;

class ValidVehiclePlate implements Rule
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
        $vehiclePlateService = new VehiclePlateService();

        return $vehiclePlateService->validatePlateNumber($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'El número de placa no es válido.';
    }
}
