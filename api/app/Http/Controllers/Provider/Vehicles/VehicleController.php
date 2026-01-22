<?php

namespace App\Http\Controllers\Provider\Vehicles;

use App\Http\Controllers\Controller;
use App\Http\Requests\Provider\CreateVehicleRequest;
use App\Http\Requests\Provider\UpdateVehicleRequest;
use App\Http\Resources\Provider\Vehicle\CreateVehicleResource;
use App\Http\Resources\Provider\Vehicle\ListVehiclesResource;
use App\Models\User;
use App\Models\Vehicle;
use App\Services\VehicleService;

class VehicleController extends Controller
{
    public function __construct(
        protected VehicleService $vehicleService
    ) {}

    public function index()
    {
        $vehicles = $this->vehicleService->getAvailableVehicles(auth()->user());

        return ListVehiclesResource::collection($vehicles);
    }

    public function store(User $provider, CreateVehicleRequest $request)
    {
        $vehicle = $provider->vehicles()->create($request->validated());

        return CreateVehicleResource::make($vehicle->load('provider'));
    }

    public function show($provider, Vehicle $vehicle)
    {
        //
    }

    public function update(UpdateVehicleRequest $request, $provider, Vehicle $vehicle)
    {
        $vehicle->update($request->validated());

        return CreateVehicleResource::make($vehicle->load('provider'));
    }

    public function destroy(User $provider, Vehicle $vehicle)
    {
        $vehicle = $provider->vehicles()->find($vehicle->id);

        abort_if(
            !$vehicle, 
            403, 
            'Non sei autorizzato a eliminare questo veicolo.'
        );

        $vehicle->delete();

        return response()->json(['message' => 'Veicolo eliminato con successo.'], 200);
    }

    public function getProviderVehicles(User $provider)
    {
        $vehicles = $this->vehicleService->getProviderVehicles($provider);

        return ListVehiclesResource::collection($vehicles);
    }

    public function getAvailableVehicles()
    {
        $vehicles = $this->vehicleService->getAvailableVehicles();

        return ListVehiclesResource::collection($vehicles);
    }
}
