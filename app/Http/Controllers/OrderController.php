<?php

namespace App\Http\Controllers;

use App\Http\Resources\AddressResource;
use App\Http\Traits\GeneralTrait;
use App\Models\Address;
use App\Models\Delivery;
use App\Models\Order;
use App\Models\User;
use App\Models\WorkTime;
use Illuminate\Http\Request;
use Auth;
use Session;
use Validator;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use Carbon\Carbon\Interface;
use IlluminateSupportFacadesSession;


class OrderController extends Controller
{
    use GeneralTrait;

    public function __construct()
    {
        $this->middleware('isadmin');

    }
    public function showorders()
    {
        $user = Auth::user()->type;
        $order = Order::query();
        if ($user === 'admin') {
            $orders = $order->get();
        } else {
            $monitor = Auth::user()->area_id;
            $customer = User::where('type', 'user')->where('area_id', $monitor)->first('id');
            $orders = $order->where('user_id', $customer);

        }
        $orders = $order->get();
        return view('order.showorders', ['orders' => $orders]);


    }
    public function showaddorder(Request $request)
    {
        if ($request->name) {
            return view('order.addorder', ['name' => $request->name, 'email' => $request->email]);
        } else {
            return view('order.addorder');
        }
    }
    public function openorder(Request $request)
    {
        $order = Order::where('id', $request->id)->first();
        $area = $order->User?->area_id;
        $delivaries = Delivery::where('area_id', $area)->get();

        return view('order.openorder', ['order' => $order, 'delivaries' => $delivaries]);


    }
    public function addorder(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => [
                'required',
                Rule::exists('users', 'name')->where('type', 'user')
            ],
            'email' => [
                'required',
                Rule::exists('users', 'email')->where('type', 'user')
            ],
            'order' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->withInput($request->all())->withErrors($validator);
        }
        Carbon::setLocale('ar');
        $now = Carbon::now();
        $DayName = $now->translatedFormat('l');

        $LookForDay = WorkTime::where('dateName', $DayName)->first();

        if ($LookForDay) {
            // dd($this->BetweenTimes($LookForDay->fromTime, $LookForDay->toTime));
            if ($this->BetweenTimes($LookForDay->fromTime, $LookForDay->toTime) == true) {
                $userData = User::where('type', 'user')->where('name', '=', $request->name)->where('email', $request->email)->first();
                // dd($userData->id);
                if ($userData->active == true) {
                    if (isset($request->time)) {
                        $scheduling = $request->time;
                        $status = 'inProgress';
                    } else {
                        $scheduling = null;
                        $status = 'waiting';
                    }

                    $lastorder = Order::latest()->first();
                    $lastordernum = $lastorder->order_number + 1;
                    $Order = [
                        'order' => htmlspecialchars($request->order),
                        'status' => $status,
                        'order_number' => $lastordernum,
                        'delivery_id' => Null,
                        'scheduledTime' => $scheduling,
                        'estimatedTime' => '',
                        'address_id' => $request->addresses,
                        'startDeliveryTime' => '',
                        'receivedTime' => '',
                        'user_id' => $userData->id,
                    ];
                    // dd( $request->addresses);
                    $CreateOrder = Order::create($Order);
                    if ($CreateOrder) {
                        $user = User::where('id', $userData->id)->first();
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
                        $data = ['message' => 'تمت اضافة طلب جديد'];
                        $pusher->trigger('order', 'add-order', $data);

                        $CreateOrder->notifications()->create([
                            'title' => 'طلب جديد',
                            'content' => 'تمت اضافة طلب جديد',
                            'channel_name' => 'order',
                            'client_name' => $user->name,
                        ]);
                        return redirect()->route('showorders');

                    }
                } else {
                    $error = 'you cant order cuz you are not suscribe';
                    return redirect()->back()->withErrors(['error' => $error]);
                }
            } else {
                $error = 'you cant order in this time';
                return redirect()->back()->withErrors(['error' => $error]);
            }
        } else {
            $error = 'you cant order in this day';
            return redirect()->back()->withErrors(['error' => $error]);
        }
    }
    public function addAddress(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        // dd($name, $email);
        $user = User::where('type', 'user')->where('name', $name)->where('email', $email)->first();
        // dd($user->id);
        if ($user) {
            $addresses = Address::where('user_id', $user->id)->get();
            return $this->apiResponse(AddressResource::collection($addresses));

        }
    }
    public function addDelivaryman(Request $request)
    {

        $order = Order::where('id', $request->id)->first();
        // dd($request->delivary_id);
        $now = Carbon::now();
        $timenow = $now->translatedFormat('H:i');
        $data = [
            'delivary_id' => $request->delivary_id,
            'status' => 'accepted',
            'startDelivaryTime' => $timenow
        ];
        $p = $order->update($data);
        if ($p) {
            return redirect()->route('openorder', ['id' => $request->id]);
        } else {
            return "حدث خطا";
        }
    }
    public function BetweenTimes($startTime, $endTime)
    {
        $currentTime = strtotime(date('H:i'));
        $startTime = strtotime($startTime);
        $endTime = strtotime($endTime);


        if (
            (
                $startTime < $endTime &&
                $currentTime >= $startTime &&
                $currentTime <= $endTime
            ) ||
            (
                $startTime > $endTime && (
                    $currentTime >= $startTime ||
                    $currentTime <= $endTime
                )
            )
        ) {
            return true;
        } else {
            return false;
        }
    }
    //
}
