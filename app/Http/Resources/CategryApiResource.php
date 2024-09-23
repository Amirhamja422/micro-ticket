<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategryApiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request): array
    {
        return [
            'Category ID' => $this->id,
            'Category name' => $this->cat_name,
            'Created Time' => $this->created_at->format('d/m/Y'),
            'Update Time' => $this->updated_at->format('d/m/Y'),
        ];
    }
}
