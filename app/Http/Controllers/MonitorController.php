<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\City;
use App\Models\Monitor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class MonitorController extends Controller
{
    public function __construct()
    {
        $this->middleware('isadmin');

    }

    public function showmonitors()
    {
        $monitors = User::where('type', '=', 'monitor')->where('active', 1)->get();
        // dd($monitors);
        return view('monitor.showmonitors', ['monitors' => $monitors]);
    }

    public function showaddmonitor()
    {
        $cities = City::get();
        return view('monitor.addmonitor', ['cities' => $cities]);
    }
    public function addmonitor(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => [
                "required",
                "email",
                "max:255",
                Rule::unique('users')->where(function ($query) {
                    return $query->where('type', 'monitor');
                }),
                        ],
            'pass' => 'required|string|min:8|max:15',
            'mobile' => 'required|string|max:15'
        ]);
        if ($validate->fails()) {
            return back()->withErrors($validate)->withInput($request->all());
        }
        // dd($request->pass);
        $user=User::create([
            'name' => $request->name,
            'password' => Hash::make("$request->pass"),
            'email' => $request->email,
            'mobile' => $request->mobile,
            'type' => $request->type,
            'active' => $request->active,
            'area_id' => $request->areaname
        ]);
        if($user){
            $d=Monitor::create([
                'user_id'=> $user->id,
                'area_id'=>$request->areaname,

            ]);
            return redirect()->route('showmonitors');

        }
    }

    public function showeditmonitor(Request $request)
    {
        $cities = City::get();
        // dd($cities);
        $monitors = User::where('id', '=', $request->id)->where('type', 'monitor')->first();
        return view('monitor.editmonitor', ['monitors' => $monitors, 'cities' => $cities]);


    }

    public function editmonitor(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => [
                "required",
                "email",
                "max:255",
                Rule::unique("users", "email")->where("type", "monitor")->ignore($request->email, 'email'),
            ],
            'pass' => 'required|string|min:8|max:15',
            'mobile' => 'required|string|max:15',
            'active' => 'required|boolean'

        ]);
        if ($validate->fails()) {
            return back()->withErrors($validate)->withInput($request->all());
        }
        $monitor = User::find($request->id);
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make("$request->pass"),
            'mobile' => $request->mobile,
            'active' => $request->active,
            'type' => $request->type,
            'area_id' => $request->areaname
        ];
        $monitor->update($data);
        return redirect()->route('showmonitors');


    }
    public function getAreas($cityId)
    {
        $coll = ['id', 'title'];
        $areas = Area::where('city_id', $cityId)->get($coll);
        // dd($areas);
        return response()->json($areas);
    }
    public function notactive()
    {
        $monitors = User::where('type', '=', 'monitor')->where('active', 0)->get();

        return view('monitor.deleted', ['monitors' => $monitors]);
    }
    public function activemonitor(Request $request)
    {
        $monitor = User::find($request->id);
        $data = [
            'active' => 1,
        ];
        $monitor->update($data);
        return redirect()->route('showmonitors');

    }

}
