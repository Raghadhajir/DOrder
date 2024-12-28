<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class PackageController extends Controller
{
    public function __construct()
    {
        $this->middleware('isadmin');

    }

    public function showpackage()
    {

        $packages = Package::all();

        return view('package.showpackages', ['packages' => $packages]);


    }
    public function showaddpackage()
    {
        return view('package.addpackage');

    }
    public function addpackage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'price' => 'required|numeric|min:0',
            'count' => 'required|integer|min:1',
            // 'price_order' => 'required|numeric|min:0',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput($request->all());
        }
        if ($request->img) {
            $d = $request->file('img')->store('images', 'public');
            $img = env('PATH_IMG') . $d;
        } else {
            $img = null;
        }
        // $data = env('PATH_IMG') . $d;

        Package::create([
            'title' => $request->title,
            'image' => $img,
            'package_price' => $request->price,
            'count_of_order' => $request->count,
            'order_price' => $request->price_order,
        ]);

        // dd($d);
        return redirect()->route('showpackage');
    }

    public function showeditpackage(Request $request)
    {
        $package = Package::where('id', '=', $request->id)->first();
        return view('package.editpackage', ['package' => $package]);
    }
    public function editpackage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required|numeric|min:0',
            'count' => 'required|integer|min:1',
            // 'price_order' => 'required|numeric|min:0',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput($request->all());
        }
        $d = $request->file('img')->store('images', 'public');

        $package = Package::find($request->id);
        $data = [
            'title' => $request->title,
            'image' => env('PATH_IMG') . $d,
            'package_price' => $request->price,
            'count_of_order' => $request->count,
            'order_price' => $request->price_order,
        ];
        $package->update($data);
        return redirect()->route('showpackage');

    }
    public function deletepackage(Request $request)
    {
        $package = Package::find($request->id);
        $package->delete();
        return redirect()->route('showpackage');
    }
    //
}
