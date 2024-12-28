<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CityResource;
use App\Models\City;
use App\Http\Traits\GeneralTrait;

use Illuminate\Http\Request;

class Cityapi extends Controller
{
    use GeneralTrait;
    public function allcities()
    {
        $cities = City::all();
        $data = CityResource::collection($cities);
        return $this->apiResponse($data);
;
    }
    public function city($id)
    {
        $city = City::where('uuid', '=', $id)->first();
        $data=CityResource::make($city);
        return $this->apiResponse($data);

    }
    //
}
