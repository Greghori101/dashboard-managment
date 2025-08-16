<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WidgetResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->id,
            'type'       => $this->type,
            'data'       => $this->data,
            'sort'       => $this->sort,
            'version_id' => $this->version_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            // relation (only when eager loaded)
            'version'    => new VersionResource($this->whenLoaded('version')),
        ];
    }
}
