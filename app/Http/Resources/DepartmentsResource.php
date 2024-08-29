<?php
namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DepartmentsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'Department ID' => $this->id,
            'Department name' => $this->name,
            'Created Time' => $this->created_at->format('d/m/Y'),
            'Update Time' => $this->updated_at->format('d/m/Y'),
        ];
    }
}
