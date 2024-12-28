<?php

namespace App\Http\Resources;

use App\Http\Traits\GeneralTrait;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
    use GeneralTrait;
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [

            'id' => $this->uuid,
            'name' => $this->name,
            'email' => $this->email,
            'mobile' => $this->mobile,
            'package' => $this->Package()->get('title'),
            'image' => $this->profile_image,
            'subscribe' => $this->subscription_fees,
            'address' => $this->address,
            'notes' => $this->notes,
            'expire' => $this->expire,
            'area' => $this->Area()->get('title'),

        ];


    }
}
