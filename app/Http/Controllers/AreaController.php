<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\City;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\MonitorController;

class AreaController extends Controller
{
    public function __construct()
    {
        $this->middleware('isadmin');

    }
    public function showareas()
    {
        $area = Area::query();
        $user = Auth::user()->type;
        if ($user === 'admin') {
            $areas = $area->get();
        } else {
            $id = Auth::user()->area_id;
            $areas = $area->where('id', $id);

        }
        $areas = $area->get();
        return view('area.showareas', ['areas' => $areas]);
    }
    public function showaddarea()
    {
        $cities = City::all();
        return view('area.addarea', ['cities' => $cities]);
    }

    public function addarea(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'areaname' => 'required|string',
        ]);
        if ($validator->fails()) {
            return back()->withInput($request->all())->withErrors($validator);
        }
        Area::create([
            'title' => $request->areaname,
            'city_id' => $request->cityname
        ]);
        return redirect()->route('showareas');
    }

    public function showeditarea(Request $request)
    {
        $area = Area::find($request->id);
        $cities = City::all();
        return view('area.editarea', ['area' => $area, 'cities' => $cities]);



    }
    public function editarea(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'areaname' => 'required|string',
        ]);
        if ($validator->fails()) {
            return back()->withInput($request->all())->withErrors($validator);
        }
        $area = Area::find($request->id);
        $data = [
            'title' => $request->areaname,
            'city_id' => $request->cityname

        ];
        // dd($request->all());
       $area->update($data);
     return redirect()->route('showareas');

        
    }
    public function deletearea(Request $request)
    {
        $area = Area::find($request->id);
        $delete = $area->delete();
        if ($delete) {
            $monitors = User::where('type', 'monitor')->where('active', 1)->where('area_id', $area->id)->get();
            foreach ($monitors as $monitor) {
                $monitor->delete();
            }
            $deliveries = User::where('type', 'deliver')->where('active', 1)->where('area_id', $area->id)->get();
            foreach ($deliveries as $delivery) {
                $delivery->delete();
            }
        }
        return redirect()->route('showareas');
    }
    public function deleted()
    {
        $deletedareas = Area::onlyTrashed()->get();
        return view('area.deletedareas', ['areas' => $deletedareas]);


    }
    public function restore(Request $request)
    {
        $restoredarea = Area::withTrashed()->find($request->id)->restore();
        return redirect()->route('showareas');

    }
    //
    //
}
