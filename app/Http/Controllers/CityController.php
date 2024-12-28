<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\City;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Unique;
use Illuminate\Support\Facades\Validator;

class CityController extends Controller
{
    public function __construct()
    {
        $this->middleware('isadmin');

    }
    public function showcities()
    {
        $cities = City::all();
        return view('city.showcities', ['cities' => $cities]);
    }
    public function showaddcity()
    {
        return view('city.addcity');
    }

    public function addcity(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cityname' => 'required|unique:cities,title|string',
        ]);
        if ($validator->fails()) {
            return back()->withInput($request->all())->withErrors($validator);
        }
        $exist = City::where('title', '=', $request->cityname)->first();
        if (!$exist) {
            City::create(['title' => $request->cityname]);
            return redirect()->route('showcities');


        } else {
            return redirect()->route('showcities');

        }

    }
    public function showeditcity(Request $request)
    {
        $city = City::find($request->id);

        return view('city.editcity', ['city' => $city]);



    }
    public function editcity(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cityname' => 'required|string',
        ]);
        if ($validator->fails()) {
            return back()->withInput($request->all())->withErrors($validator);
        }
        $city = City::find($request->id);
        $data = [
            'title' => $request->cityname,
        ];
        // dd($request->all());
        $city->update($data);
        return redirect()->route('showcities');


    }

    public function deletecity(Request $request)
    {
        $city = City::find($request->id);
        $delete = $city->delete();
        if ($delete) {
            $areas = Area::where('city_id', $request->id)->get();
            foreach ($areas as $area) {
                $area->delete();
                $monitors = User::where('type', 'monitor')->where('active', 1)->where('area_id', $area->id)->get();
                foreach ($monitors as $monitor) {
                    $monitor->delete();
                }
                $deliveries = User::where('type', 'deliver')->where('active', 1)->where('area_id', $area->id)->get();
                foreach ($deliveries as $delivery) {
                    $delivery->delete();
                }
            }

        }
        ;
        return redirect()->route('showcities');
    }
    public function deleted()
    {
        $deletedcities = City::onlyTrashed()->get();
        return view('city.deletedcities', ['cities' => $deletedcities]);


    }
    public function restore(Request $request)
    {
        $restoredcities = City::withTrashed()->find($request->id)->restore();
        return redirect()->route('showcities');

    }
    //
}
