<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AllNotificationResource;
use App\Http\Traits\GeneralTrait;
use Illuminate\Http\Request;

class AllNotification extends Controller
{
    use GeneralTrait;
    public function AddCustomerNotify(){
        $notifications=\App\Models\AllNotification::where('channel_name','customer')->get();
        return $this->apiResponse(AllNotificationResource::collection($notifications));
    }
    public function AddOrderNotify(){
        $notifications=\App\Models\AllNotification::where('channel_name','order')->get();
        return $this->apiResponse(AllNotificationResource::collection($notifications));
    }
    //
}
