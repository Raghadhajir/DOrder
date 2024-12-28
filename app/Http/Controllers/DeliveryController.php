<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\City;
use App\Models\Delivery;
use App\Models\Monitor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Auth;


class DeliveryController extends Controller
{

    public function __construct()
    {
        $this->middleware('isadmin');

    }

    public function showdeliveries()
    {
        $user = Auth::user()->type;
        $deliver = User::query();
        if ($user === 'admin') {
            $deliveries = $deliver->where('type', '=', 'deliver')->where('active', 1)->get();
        } else {
            $id = Auth::user()->area_id;
            $deliveries = $deliver->where('type', '=', 'deliver')->where('active', 1)->where('area_id', $id);

        }
        $deliveries = $deliver->get();
        return view('delivery.showdeliveries', ['deliveries' => $deliveries]);
    }

    public function showadddelivery()
    {
        $cities = City::all();
        return view('delivery.adddelivery', ['cities' => $cities]);
    }
    public function adddelivery(Request $request)
    {

        $validate = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => [
                "required",
                "email",
                "max:255",
                Rule::unique('users','email')->where(function ($query) {
                    return $query->where('type', 'deliver');
                }),
                        ],
            'pass' => 'required|string|min:8|max:15',
            'mobile' => 'required|string|max:15',
        ]);
        if ($validate->fails()) {
            return back()->withErrors($validate)->withInput($request->all());

        }
        $user = User::create([
            'name' => $request->name,
            'password' => Hash::make("$request->pass"),
            'email' => $request->email,
            'mobile' => $request->mobile,
            'type' => $request->type,
            'active' => $request->active,
            'area_id' => $request->areaname
        ]);
        if ($user) {
            $monitorid=Monitor::where('area_id',$request->areaname)->first('id');
            $d=Delivery::create([
                'user_id'=> $user->id,
                'area_id'=>$request->areaname,
                'monitor_id'=>$monitorid->id
            ]);

            return redirect()->route('showdeliveries');
        }
    }
    public function showeditdelivery(Request $request)
    {
        $cities = City::all();
        $deliveries = User::where('id', '=', $request->id)->first();
        return view('delivery.editdeliveries', ['deliveries' => $deliveries, 'cities' => $cities]);
    }
    public function editdelivery(Request $request)
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

        $deliver = User::find($request->id);
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make("$request->pass"),
            'mobile' => $request->mobile,
            'active' => $request->active,
            'type' => $request->type,
            'area_id' => $request->areaname
        ];
        $deliver->update($data);
        return redirect()->route('showdeliveries');
    }
    public function delivernotactive()
    {
        $user = Auth::user()->type;
        $deliver = User::query();
        if ($user === 'admin') {
            $deliveries = $deliver->where('type', '=', 'deliver')->where('active', 0)->get();
        } else {
            $id = Auth::user()->area_id;
            $deliveries = $deliver->where('type', '=', 'deliver')->where('active', 0)->where('area_id', $id);

        }
        $deliveries = $deliver->get();
        return view('delivery.deleted', ['deliveries' => $deliveries]);
    }
    public function activatedeliver(Request $request)
    {
        $deliver = User::find($request->id);
        $data = [
            'active' => 1,
        ];
        $deliver->update($data);
        return redirect()->route('showdeliveries');
    }
    //
}
