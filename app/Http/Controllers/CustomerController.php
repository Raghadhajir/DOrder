<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Area;
use App\Models\City;
use App\Models\Monitor;
use App\Models\Package;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Auth;
use Illuminate\Validation\Rule;
use Pusher\Pusher;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('isadmin');

    }
    public function showcustomer()
    {
        $user = Auth::user()->type;
        $customer = User::query();
        if ($user === 'admin') {
            $customers = $customer->where('type', 'user')->where('active', 1)->get();
        } else {
            $id = Auth::user()->area_id;
            $customers = $customer->where('type', 'user')->where('active', 1)->where('area_id', $id);

        }
        $customers = $customer->get();
        return view('customer.showcustomers', ['customers' => $customers]);

    }
    public function showaddcustomer()
    {
        $cities = City::get();
        $packages = Package::get();
        return view('customer.addcustomer', ['cities' => $cities, 'packages' => $packages]);
    }
    public function addcustomer(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => [
                "required",
                "email",
                "max:255",
                Rule::unique('users', 'email')->where(function ($query) {
                    return $query->where('type', 'user');
                }),
            ],
            'pass' => 'required|string|min:8|max:15',
            'mobile' => 'required|string|max:15',
            'address' => 'required|string',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'package_id' => 'nullable|exists:packages,id',
            'supscripe' => 'nullable|numeric',
            'area_id' => 'nullable|exists:areas,id'

        ]);
        if ($validate->fails()) {
            return back()->withErrors($validate)->withInput($request->all());
        }
        //تفعيل الجساب
        if (isset($request->package_id) || isset($request->supscripe)) {
            $active = 1;
        } else {
            $active = 0;
        }
        //اذا بعت صورة او لا
        // dd($request->image);
        if (isset($request->img)) {
            $show = $request->file('img')->store('customer', 'public');
        } else {
            $show = null;
        }
        if (isset($request->supscripe)) {
            $date = Carbon::now();
            $Day = $date->translatedFormat('y:m:d');
        } else {
            $Day = null;
        }
        $user = User::create([
            'name' => $request->name,
            'password' => Hash::make("$request->pass"),
            'email' => $request->email,
            'mobile' => $request->mobile,
            'type' => $request->type,
            'address' => $request->address,
            'profile_image' => env('PATH_IMG') . $show,
            'package_id' => $request->package_id,
            'subscription_fees' => $request->supscripe,
            'date_subscribe' => $Day,
            'area_id' => $request->area_id,
            'active' => $active,
        ]);
        if ($user) {
            if ($request->address) {
                Address::create([
                    'user_id' => $user->id,
                    'area_id' => $request->area_id,
                    'address' => $request->address
                ]);
            }
            $options = array(
                'cluster' => 'us2',
                'useTLS' => true
            );
            $pusher = new \Pusher\Pusher(
                env('PUSHER_APP_KEY'),
                env('PUSHER_APP_SECRET'),
                env('PUSHER_APP_ID'),
                $options

            );

            //$data['message'] = 'hello world';
            $data = ['message' => 'تمت اضافة عميل جديد'];
            $pusher->trigger('customer', 'add-customer', $data);

            $user->notifications()->create([
                'title' => 'مشترك جديد',
                'content' => 'تمت اضافة عميل جديد',
                'channel_name' => 'customer',
                'client_name' => $user->name,
            ]);
            if ($user->active == 1) {
                return redirect()->route('showcustomer');
            } else {
                return redirect()->route('customernotactive');

            }


        }

    }
    public function detailscustomer(Request $request)
    {
        $customer = User::where('id', $request->id)->where('type', 'user')->first();
        $addresses = Address::where('user_id', $request->id)->get();
        // dd($addresses);
        $packages = Package::all();
        $cities = City::all();
        return view('customer.details', ['customer' => $customer, 'addresses' => $addresses, 'packages' => $packages, 'cities' => $cities]);

    }

    public function addpackageforclient(Request $request)
    {
        $customer = User::where('id', $request->id)->where('type', 'user')->first();
        $data = [
            'package_id' => $request->package_id,
        ];

        $p = $customer->update($data);
        if ($p) {
            return redirect()->route('detailscustomer', ['id' => $request->id]);
        } else {
            return "حدث خطا";
        }
    }
    public function add_supscripe_for_client(Request $request)
    {
        $customer = User::where('id', $request->id)->where('type', 'user')->first();
        $date = Carbon::now();
        $Day = $date->translatedFormat('y:m:d');
        $data = [
            'subscription_fees' => $request->suscripe,
            'date_subscribe' => $Day,
        ];

        $p = $customer->update($data);
        if ($p) {
            return redirect()->route('detailscustomer', ['id' => $request->id]);
        } else {
            return "حدث خطا";
        }
    }
    public function customernotactive()
    {
        $user = Auth::user()->type;
        $customer = User::query();
        if ($user === 'admin') {
            $customers = $customer->where('type', 'user')->where('active', 0)->get();
        } else {
            $id = Auth::user()->area_id;
            $customers = $customer->where('type', 'user')->where('active', 0)->where('area_id', $id);

        }
        $customers = $customer->get();
        return view('customer.deleted', ['customers' => $customers]);

    }
    public function activecustomer(Request $request)
    {
        $customer = User::find($request->id);
        $data = [
            'active' => 1,
        ];
        $customer->update($data);
        return redirect()->back()->with('id', $request->id);

    }
    public function notactivecustomer(Request $request)
    {
        $customer = User::find($request->id);
        $data = [
            'active' => 0,
        ];
        $customer->update($data);
        return redirect()->route('detailscustomer', ['id' => $request->id]);

    }
    //
}
