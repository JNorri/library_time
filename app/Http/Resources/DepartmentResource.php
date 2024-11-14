<?php

namespace App\Http\Resources;

use App\Models\Department;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DepartmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'department_id' => $this->department_id,
            'department_name' => $this->department_name,
            'department_description' => $this->department_description,
            'parent_id' => $this->parent_id,
        ];
    }
}
