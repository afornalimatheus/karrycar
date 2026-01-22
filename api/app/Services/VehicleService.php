<?php

namespace App\Services;

use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Collection;

class VehicleService
{
    /**
     * Get all available vehicles ordered by provider.
     *
     * @return Collection
     */
    public function getAvailableVehicles(): Collection
    {
        return Vehicle::orderBy('provider_id')
            ->with('provider')
            ->get();
    }
}
