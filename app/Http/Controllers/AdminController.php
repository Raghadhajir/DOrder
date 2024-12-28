<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Monitor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('isadmin');

    }

    public function showadmins()
    {
        $admins = User::where('type', '=', 'admin')->where('active', 1)->get();

        return view('admin.showadmins', ['admins' => $admins]);
    }
    public function showaddadmin()
    {
        return view('admin.addadmin');
    }
    public function addadmin(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => [
                "required",
                "email",
                "max:255",
                Rule::unique('users')->where(function ($query) {
                    return $query->where('type', 'admin');
                }),            ],
            'pass' => 'required|string|min:8|max:15',
            'mobile' => 'required|string|max:15',
        ]);
        if ($validate->fails()) {
            return back()->withErrors($validate)->withInput($request->all());
        }

        // dd($request->pass);
        User::create([
            'name' => $request->name,
            'password' => Hash::make("$request->pass"),
            'email' => $request->email,
            'mobile' => $request->mobile,
            'type' => $request->type,
        ]);
        return redirect()->route('showadmins');
    }
    public function showeditadmin(Request $request)
    {
        $admin = User::where('id', '=', $request->id)->first();
        return view('admin.editadmin', ['admin' => $admin]);
    }
    public function editadmin(Request $request)
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
        ]);
        if ($validate->fails()) {
            return back()->withErrors($validate)->withInput($request->all());
        }
        $admin = User::find($request->id);
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make("$request->pass"),
            'mobile' => $request->mobile,
            'active' => $request->active,
            'type' => $request->type,
        ];
        $admin->update($data);
        return redirect()->route('showadmins');


    }
    public function notactive()
    {
        $admins = User::where('type', '=', 'admin')->where('active', 0)->get();

        return view('admin.deleted', ['admins' => $admins]);
    }
    public function activeadmin(Request $request)
    {
        $admin = User::find($request->id);
        $data = [
            'active' => 1,
        ];
        $admin->update($data);
        return redirect()->route('showadmins');

    }
    //
}
