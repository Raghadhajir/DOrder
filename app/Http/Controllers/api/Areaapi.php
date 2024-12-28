<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AreaResource;
use App\Http\Traits\GeneralTrait;
use App\Models\Area;
use Illuminate\Http\Request;

class Areaapi extends Controller
{
    use GeneralTrait;
    public function allareas()
    {
        $areas = Area::all();
        return $this->apiResponse(AreaResource::collection($areas)) ;
    }
    public function area($id)
    {
        $area = Area::where('uuid', '=', $id)->first();
        return $this->apiResponse(AreaResource::make($area));

    }
    //
}
