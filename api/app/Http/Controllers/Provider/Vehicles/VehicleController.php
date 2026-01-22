<?php

namespace App\Http\Controllers\Provider\Vehicles;

use App\Http\Controllers\Controller;
use App\Http\Requests\Provider\CreateVehicleRequest;
use App\Http\Requests\Provider\UpdateVehicleRequest;
use App\Http\Resources\Provider\Vehicle\CreateVehicleResource;
use App\Http\Resources\Provider\Vehicle\ListVehiclesResource;
use App\Models\User;
use App\Models\Vehicle;

class VehicleController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::with('provider')->get();

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
}
