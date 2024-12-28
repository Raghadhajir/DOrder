<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AddressResource;
use App\Http\Resources\OrderResource;
use App\Http\Traits\GeneralTrait;
use App\Models\Address;
use App\Models\Area;
use App\Models\Order;
use App\Models\User;
use App\Models\WorkTime;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class Orderapi extends Controller
{
    use GeneralTrait;
    public function addorder(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order' => 'required',
        ]);
        if ($validator->fails()) {
            $error = $validator->errors()->first();
            return $this->apiResponse(null, false, $error, 400);
        }
        Carbon::setLocale('ar');
        $now = Carbon::now();
        $DayName = $now->translatedFormat('l');
        $LookForDay = WorkTime::where('dateName', $DayName)->first();

        if ($LookForDay) {
            // dd($this->BetweenTimes($LookForDay->fromTime, $LookForDay->toTime));
            if ($this->BetweenTimes($LookForDay->fromTime, $LookForDay->toTime) == true) {
                $id = auth()->user()->id;
                $userData = User::where('type', 'user')->where('id', '=', $id)->first();
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
                    $address = Address::where('uuid', $request->address_id)->first();
// dd($address->id);
                    $Order = [
                        'order' => htmlspecialchars($request->order),
                        'status' => $status,
                        'order_number' => $lastordernum,
                        'delivery_id' => Null,
                        'scheduledTime' => $scheduling,
                        'estimatedTime' => '',
                        'address_id' => $address->id,
                        'startDeliveryTime' => '',
                        'receivedTime' => '',
                        'user_id' => $id,
                    ];
                    // dd( $request->addresses);
                    $CreateOrder = Order::create($Order);
                    if ($CreateOrder) {
                        $user = User::where('id', $id)->first();
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
                        $data1 = ['message' => 'تمت اضافة طلب جديد'];
                        $pusher->trigger('order', 'add-order', $data1);

                        $CreateOrder->notifications()->create([
                            'title' => 'طلب جديد',
                            'content' => 'تمت اضافة طلب جديد',
                            'channel_name' => 'order',
                            'client_name' => $user->name,
                        ]);
                        // dd($CreateOrder);
                        $data['order'] = OrderResource::make($CreateOrder);
                        // dd($data);
                        return $this->apiResponse($data);

                    }
                } else {
                    $error = 'you cant order cuz you are not suscribe';
                    return $this->apiResponse(null, false, $error, 200);
                }
            } else {
                $error = 'you cant order in this time';
                return $this->apiResponse(null, false, $error, 200);
            }
        } else {
            $error = 'you cant order in this day';
            return $this->apiResponse(null, false, $error, 200);
        }





    }
    public function sendemail()
    {
        $template = "email.activation_code";
        // $email = "reem.georges1@gmail.com";
        $email = "reem.georges1@gmail.com";
        $subj = "to my lovely coach reem";
        $order = ["text" => "love you my sweet"];
        $send = $this->send_email($template, $email, $subj, $order);
        // dd($send);
        if ($send) {
            return $this->apiResponse(null, true, null, 200);
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
