<?php
namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketsResource extends JsonResource
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
            'Ticket ID' => $this->id,
            'Contact name' => $this->contact_name,
            'Email' => $this->email,
            'Status' => $this->status,
            'Description' => $this->description,
            'Created Time' => $this->created_at->format('d/m/Y'),
            'Update Time' => $this->updated_at->format('d/m/Y'),
        ];
    }
}
