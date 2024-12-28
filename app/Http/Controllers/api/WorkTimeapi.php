<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\WorkTimeResource;
use App\Http\Traits\GeneralTrait;
use App\Models\WorkTime;
use Illuminate\Http\Request;

class WorkTimeapi extends Controller
{
    use GeneralTrait;
    public function worktimes()
    {
        $times = WorkTime::all();
        return $this->apiResponse(WorkTimeResource::collection($times))  ;
    }
    public function timebyid($id)
    {
        $package = WorkTime::where('uuid', $id)->first();
        return $this->apiResponse( WorkTimeResource::make($package));

    }
    public function timebyname($day)
    {
        $package = WorkTime::where('dateName', $day)->first();
        return $this->apiResponse(WorkTimeResource::make($package));

    }
    //
}
