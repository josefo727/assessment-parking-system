<?php

namespace App\Services;

use Illuminate\Support\Arr;

class VehiclePlateService
{
    protected $oldFormatDigits = 3;
    protected $newFormatDigits = 4;

    /**
     * @return string
     */
    public function generatePlateNumber(): string
    {
        $letters = range('A', 'Z');

        // Generate the letters for the plate
        $plate = '';
        for ($i = 0; $i < 3; $i++) {
            $plate .= Arr::random($letters);
        }

        // Generate the digits for the plate
        $plate .= '-';
        $plate .= mt_rand(100,9999);

        return $plate;
    }

    /**
     * @return bool
     * @param mixed $plateNumber
     */
    public function validatePlateNumber($plateNumber): bool
    {
        $pattern = '/^[A-Z]{3}-\d{' . $this->oldFormatDigits . ',' . $this->newFormatDigits . '}$/';

        return (bool) preg_match($pattern, $plateNumber);
    }
}
