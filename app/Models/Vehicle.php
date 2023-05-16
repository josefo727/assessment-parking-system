<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vehicle extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * @return BelongsTo
     */
    public function vehicleType(): BelongsTo
    {
        return $this->belongsTo(VehicleType::class);
    }

    /**
    * Apply a filter to retrieve records based on customer or plate.
    *
    * @param \Illuminate\Database\Eloquent\Builder $query
    * @param string|null $search
    * @return \Illuminate\Database\Eloquent\Builder
    */
    public function scopeFilterByCustomerOrByPlate(Builder $query, string $search = null): Builder
    {
        return $query->where(function ($subQuery) use ($search) {
            $subQuery->whereHas('customer', function ($customerQuery) use ($search) {
                $customerQuery->where('name', 'LIKE', "%{$search}%");
            })->orWhere('plate', 'LIKE', "%{$search}%");
        })
        ->orderBy('id', 'desc');
    }
}
