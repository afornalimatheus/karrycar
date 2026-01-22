<?php

namespace App\Services;

use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Collection;

class VehicleService
{
    public function getAvailableVehicles(?User $provider = null): Collection
    {
        if ($provider) {
            return Vehicle::where('provider_id', $provider->id)
                ->orderBy('provider_id')
                ->with('provider')
                ->get();
        }

        return Vehicle::orderBy('provider_id')
            ->with('provider')
            ->get();
    }

    public function getProviderVehicles(User $provider): Collection
    {
        return Vehicle::where('provider_id', $provider->id)
            ->with('provider')
            ->get();
    }
}
