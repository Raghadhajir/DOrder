<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->uuid,
            'order' => $this->order,
            'order_number' => $this->order_number,
            'status' => $this->status,
            'delivery_id' => $this->Delivary?->name,
            'scheduledTime' => $this->scheduledTime,
            'address' => AddressApiResource::make($this->Address),
            'canceled' => $this->canceled,
            'user' => CustomerResource::collection($this->User()->get()),
            'rate' => $this->rate,

        ];
    }
}
