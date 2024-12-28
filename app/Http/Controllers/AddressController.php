<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\User;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function add_address_for_client(Request $request)
    {
        $customer = User::where('id', $request->id)->where('type', 'user')->first('id');
        $a = Address::create([
            'user_id' => $customer->id,
            'area_id' => $request->area_id,
            'address' => $request->address
        ]);

        if ($a) {
            return redirect()->route('detailscustomer', ['id' => $request->id]);

        }


    }
    public function deleteaddress(Request $request)
    {
        $address = Address::where('id', $request->id)->first();
        $a = $address->delete();
        if ($a) {
            return redirect()->route('detailscustomer', ['id' => $address->user_id]);
        }
    }
    //
}
