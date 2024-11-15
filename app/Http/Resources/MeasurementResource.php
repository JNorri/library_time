<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MeasurementResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'measurement_id' => $this->measurement_id,
            'measurement_name' => $this->measurement_name,
            'measurement_description' => $this->measurement_description,
        ];
    }
}
