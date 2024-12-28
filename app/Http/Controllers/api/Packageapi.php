<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PackageResource;
use App\Http\Traits\GeneralTrait;
use App\Models\Package;
use Illuminate\Http\Request;

class Packageapi extends Controller
{
    use GeneralTrait;
    public function allpackages()
    {
        $packages = Package::all();
        return $this->apiResponse(PackageResource::collection($packages)) ;
    }
    public function package($id)
    {
        $package = Package::where('uuid', $id)->first();
        return $this->apiResponse(PackageResource::make($package)) ;

    }
    //
}
