<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Services\RecordCalculationService;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Record extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'entry_at' => 'datetime',
        'exit_at' => 'datetime',
    ];

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function elapsedTimeForHumans(): string
    {
        $service = new RecordCalculationService($this->entry_at, $this->exit_at);
        return $service->calculateInHoursAndMinutes();
    }

    public function threeOrMoreRecordsToday()
    {
        return static::query()
            ->whereDate('entry_at', now())
            ->where('vehicle_id', $this->vehicle_id)
            ->whereNotNull('exit_at')
            ->count() >= 3;
    }

    public function isThisServiceFree(): bool
    {
        return $this->threeOrMoreRecordsToday()
            || (
                $this->vehicle->customer->registeredFromAllCategoriesLastMonth()
                && $this->vehicle->customer->isTheFirstEntryOfTheMonth()
            );
    }

    public function recordOutput(): void
    {
        $isFree = $this->isThisServiceFree();
        $this->exit_at = now();
        $service = new RecordCalculationService($this->entry_at, $this->exit_at);
        $rate = $this->vehicle->vehicleType->hourly_rate;
        $this->total_amount = $isFree ? 0 : $service->calculateTotalAmount($rate);
        $this->save();
    }

}
