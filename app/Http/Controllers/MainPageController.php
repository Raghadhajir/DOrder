<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Validator;

class MainPageController extends Controller
{
    public function showmainpage(Request $request)
    {
        $cities = City::all();
        return view('mainpage.search', ['cities' => $cities]);
    }
    public function getorder(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_number' => 'nullable|integer',
        ]);
        if ($validator->fails()) {
            return back()->withInput($request->all())->withErrors($validator);
        }
        $order = Order::where('order_number', $request->order_number)->first();
        $cities = City::all();
        return view('mainpage.search', ['order' => $order, 'cities' => $cities]);

    }
    public function checkclients(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'nullable|string',
            'email' => 'nullable|email'
        ]);
        if ($validator->fails()) {
            return back()->withInput($request->all())->withErrors($validator);
        }
        $users = User::query()->where('type', 'user');
        if ($request->name) {
            $users->where('name', $request->name);
        }
        if ($request->email) {
            $users->where('email', $request->email);

        }
        if ($request->areaname) {
            $users->where('area_id', $request->areaname);
        }
        $clients = $users->get();
        $cities = City::all();
        return view('mainpage.search', ['clients' => $clients, 'cities' => $cities]);
    }
    public function TodaysOrders()
    {
        $orders = Order::whereDate('created_at', Carbon::today())->get();
        return view('order.showorders', ['orders' => $orders]);

    }
    //
}
