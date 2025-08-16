<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DashboardResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                => $this->id,
            'name'              => $this->name,
            'user_id'           => $this->user_id,
            'current_version_id'=> $this->current_version_id,
            'created_at'        => $this->created_at,
            'updated_at'        => $this->updated_at,

            // relations
            'current_version'   => new VersionResource($this->whenLoaded('currentVersion')),
            'versions'          => VersionResource::collection($this->whenLoaded('versions')),
        ];
    }
}
