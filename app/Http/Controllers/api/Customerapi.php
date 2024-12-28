<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerResource;
use App\Http\Traits\GeneralTrait;
use App\Models\User;
use Illuminate\Http\Request;

class Customerapi extends Controller
{
    use GeneralTrait;
    public function allcustomers()
    {
        $customers = User::where('type', '=', 'user')->where('active', '=', 1)->get();
        $data = CustomerResource::collection($customers);
        return $this->apiResponse($data);
    }

    public function customer($id)
    {
        $customer = User::where('type', '=', 'user')->where('active', '=', 1)->where('uuid', $id)->first();
        return $this->apiResponse(CustomerResource::make($customer));

    }
    //
}
