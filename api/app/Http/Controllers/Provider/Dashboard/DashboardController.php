<?php

namespace App\Http\Controllers\Provider\Dashboard;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\VehicleService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class DashboardController extends Controller
{
    protected $vehicleService;

    public function __construct(VehicleService $vehicleService)
    {
        $this->vehicleService = $vehicleService;
    }

    public function index(Request $request)
    {
        return response()->json(['message' => 'Provider Dashboard'], 200);
    }

    public function stats(User $provider, Request $request): JsonResponse
    {
        $totalVehiclesProvider = $this->vehicleService->getTotalProviderVehicles($provider);
        $availableVehicles = 0; // $this->vehicleService->getProviderVehicles($provider);

        $stats = [
            'total_vehicles' => $totalVehiclesProvider,
            'vehicles' => $availableVehicles,
            'active_reservations' => 0, // $provider->reservations()->where('status', 'active')->count(),
            'completed_reservations' => 0, // $provider->reservations()->where('status', 'completed')->count(),
        ];

        return response()->json($stats, 200);
    }
}
