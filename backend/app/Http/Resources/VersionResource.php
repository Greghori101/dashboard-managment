<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VersionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'           => $this->id,
            'number'       => $this->number,
            'dashboard_id' => $this->dashboard_id,
            'created_at'   => $this->created_at,
            'updated_at'   => $this->updated_at,

            // relations
            'widgets'      => WidgetResource::collection($this->whenLoaded('widgets')),
            'dashboard'    => new DashboardResource($this->whenLoaded('dashboard')),
        ];
    }
}
