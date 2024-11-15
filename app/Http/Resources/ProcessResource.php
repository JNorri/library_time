<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProcessResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'process_id' => $this->process_id,
            'process_name' => $this->process_name,
            'measurement_id' => new MeasurementResource($this->measurement),
            'is_daily' => $this->is_daily,
            'require_description' => $this->require_description,
            'department_id' => new DepartmentResource($this->department),
            'process_duration' => $this->process_duration,
        ];
    }
}
