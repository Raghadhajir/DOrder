<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\RegisterResource;
use App\Http\Traits\GeneralTrait;
use App\Models\Address;
use App\Models\Area;
use App\Models\Package;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;



use Illuminate\Http\Request;

class RegisterApi extends Controller
{
    use GeneralTrait;
    public function register(Request $request)
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
            'package_id' => 'nullable|exists:packages,uuid',
            'supscripe' => 'nullable|numeric',
            'area_id' => 'nullable|exists:areas,uuid'

        ]);
        if ($validate->fails()) {
            $error = $validate->errors()->first();
            return $this->apiResponse(null, false, $error, 400);
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
        $package = Package::where('uuid', $request->package_id)->first();
        $area = Area::where('uuid', $request->area_id)->first();
        // dd();
        $user = User::create([
            'name' => $request->name,
            'password' => Hash::make("$request->pass"),
            'email' => $request->email,
            'mobile' => $request->mobile,
            'type' => 'user',
            'address' => $request->address,
            'profile_image' => env('PATH_IMG') . $show,
            'package_id' => $package->id,
            'subscription_fees' => $request->supscripe,
            'date_subscribe' => $Day,
            'area_id' => $area->id,
            'active' => $active,
        ]);
        if ($user) {
            if ($request->address) {
                Address::create([
                    'user_id' => $user->id,
                    'area_id' => $area->id,
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
            $data1 = ['message' => 'تمت اضافة عميل جديد'];
            $pusher->trigger('customer', 'add-customer', $data1);

            $user->notifications()->create([
                'title' => 'مشترك جديد',
                'content' => 'تمت اضافة عميل جديد',
                'channel_name' => 'customer',
                'client_name' => $user->name,
            ]);
            $data[] = RegisterResource::make($user);

            return $this->apiResponse($data);


        }




        // } catch (Exception $e) {

        //     // $error = 'حدث خطأ ما, يرجى اعادة المحاولة';
        //     return $this->apiResponse(null,true,$e,500);
        // }

        //
    }
}
