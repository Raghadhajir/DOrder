<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AddressApiResource;
use App\Http\Resources\AddressResource;
use App\Http\Traits\GeneralTrait;
use App\Models\Address;
use Auth;
use Illuminate\Http\Request;

class Addressapi extends Controller
{
    use GeneralTrait;
    public function addressesForClient(){
        $id = auth()->user()->id;
         $addresses = Address::where('user_id', $id)->get();
         return $this->apiResponse( AddressApiResource::collection($addresses));


    }
    //
}
