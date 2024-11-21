<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PermissionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            "permission_id" => $this->permission_id,
            "permission_name" => $this->permission_name,
            "slug" => $this->slug,
            "permission_description" => $this->permission_description,
        ];
    }
}
