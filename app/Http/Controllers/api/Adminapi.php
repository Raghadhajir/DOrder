<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AdminResource;
use App\Http\Traits\GeneralTrait;
use App\Models\AdminNotification;
use App\Models\User;
use Illuminate\Http\Request;

class Adminapi extends Controller
{
    use GeneralTrait;
    public function alladmins()
    {
        $admins = User::where('type', '=', 'admin')->where('active','=',1)->get();
        return $this->apiResponse( AdminResource::collection($admins));

    }
  
}
