<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DeliveryResource;
use App\Http\Traits\GeneralTrait;
use App\Models\User;
use Illuminate\Http\Request;

class Deliveryapi extends Controller
{
    use GeneralTrait;
    public function alldeliveries()
    {
        $deliveries = User::where('type', '=', 'deliver')->where('active', '=', 1)->get();
        return $this->apiResponse(DeliveryResource::collection($deliveries)) ;

    }
    public function delivery($id)
    {
        $delivery = User::where('type', '=', 'deliver')->where('active', '=', 1)->where('uuid', $id)->first();
        return $this->apiResponse(DeliveryResource::make($delivery));

    }
}
