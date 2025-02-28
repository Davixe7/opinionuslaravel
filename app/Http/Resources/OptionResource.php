<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OptionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'survey_id' => $this->survey_id,
            'name' => $this->name,
            'url' => $this->url,
            'link' => $this->link,
            'image' => $this->getFirstMediaUrl('images'),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
