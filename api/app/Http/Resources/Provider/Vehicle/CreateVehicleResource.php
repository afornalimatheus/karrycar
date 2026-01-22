<?php

namespace App\Http\Resources\Provider\Vehicle;

use App\Http\Resources\User\SimpleUserResource;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource as JsonJsonResource;

/**
 * )
 *
 * @mixin Vehicle
 */
class CreateVehicleResource extends JsonJsonResource
{
    /**
     * @param Request $request
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'brand' => $this->brand,
            'model' => $this->model,
            'license_plate' => $this->license_plate,
            'provider' => new SimpleUserResource($this->whenLoaded('provider')),
        ];
    }
}