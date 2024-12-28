<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MonitorResource;
use App\Http\Traits\GeneralTrait;
use App\Models\User;
use Illuminate\Http\Request;

class Monitorapi extends Controller
{
    use GeneralTrait;
    public function allmonitors()
    {
        $monitors = User::where('type', '=', 'monitor')->where('active', '=', 1)->get();
        return $this->apiResponse(MonitorResource::collection($monitors)) ;
    }
    public function monitor($id)
    {
        $customer = User::where('type', '=', 'monitor')->where('active', '=', 1)->where('uuid', $id)->first();
        return $this->apiResponse(MonitorResource::make($customer)) ;

    }
    //
}
