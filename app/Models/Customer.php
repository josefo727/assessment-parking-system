<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function vehicles(): HasMany
    {
        return $this->hasMany(Vehicle::class);
    }

    public function registeredFromAllCategoriesLastMonth(): bool
    {
        $ownerVehiclesId = $this->fresh()->vehicles->pluck('id')->toArray();

        $vehiclesId = Record::query()
            ->whereMonth('exit_at', now()->subMonth())
            ->whereIn('vehicle_id',$ownerVehiclesId)
            ->get()
            ->pluck('vehicle_id')
            ->toArray();

        $quantityVehiclesTypes = Vehicle::query()
            ->find($vehiclesId)
            ->unique('vehicle_type_id')
            ->pluck('vehicle_type_id')
            ->count();

        return $quantityVehiclesTypes === VehicleType::query()->count();
    }

    public function isTheFirstEntryOfTheMonth(): bool
    {
        $ownerVehiclesId = $this->fresh()->vehicles->pluck('id')->toArray();

        return Record::query()
            ->whereMonth('entry_at', now())
            ->whereIn('vehicle_id',$ownerVehiclesId)
            ->count() === 1;
    }
}
