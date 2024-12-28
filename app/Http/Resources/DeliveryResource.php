<?php

namespace App\Http\Resources;

use App\Http\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DeliveryResource extends JsonResource
{
    use GeneralTrait;
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request)
    {
       return [
            'id' => $this->uuid,
            'name' => $this->name,
            'mobile' => $this->mobile,
            'area' => AreaResource::collection($this->Area()->get()),
            'monitor' => $this->Monitors()->get()
        ];

    }
}
