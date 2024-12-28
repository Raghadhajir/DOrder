<?php

namespace App\Http\Resources;

use App\Http\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MonitorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            'id' =>$this->uuid,
            'name' => $this->name,
            'mobile' => $this->mobile,
            'areas' => AreaResource::collection($this->Area()->get())
        ];

    }
}
