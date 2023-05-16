<?php

namespace App\Services;

use DateInterval;

class RecordCalculationService
{
    protected $entryAt;
    protected $exitAt;

    /**
     * @param mixed $entryAt
     * @param mixed $exitAt
     */
    public function __construct($entryAt, $exitAt = null)
    {
        $this->entryAt = $entryAt;
        $this->exitAt = $exitAt ?? now();
    }

    public function calculateElapsedTime(): DateInterval
    {
        return $this->exitAt->diff($this->entryAt);
    }

    public function calculateInHoursAndMinutes(): string
    {
        $diff = $this->calculateElapsedTime();

        $hours = $diff->h;
        $minutes = $diff->i;

        return sprintf('%02d:%02d', $hours, $minutes);
    }

    public function calculateInHours(): float
    {
        $diff = $this->calculateElapsedTime();

        $hours = (float) $diff->h;
        $minutes = (float) $diff->i;
        $fraction = $minutes/60;

        return $hours + $fraction;
    }

    /**
     * @param mixed $rate
     */
    public function calculateTotalAmount($rate): float
    {
        return $this->calculateInHours() * $rate;
    }

}
