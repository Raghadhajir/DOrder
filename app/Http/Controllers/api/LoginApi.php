<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LoginResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Traits\GeneralTrait;
use Illuminate\Support\Facades\Validator;



class LoginApi extends Controller
{
    use GeneralTrait;

    public function login(Request $request)
    {
        $validator = validator::make($request->all(),[
            'email' => 'required',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
             $error=$validator->errors()->first();
             return $this->apiResponse(null,false,$error,400);
        }
        $user = User::where('email', '=', $request->email)->first();

        if (!$user) {
            $error = 'your email not found';
            return $this->apiResponse(null, false, $error, 404);
        }
        if (Hash::check($request->password, $user->password)) {
            $data["user"] = LoginResource::make($user);
            $token = $user->createToken('customer')->plainTextToken;
            $data["token"] = $token;
            return $this->apiResponse($data);
        } else {
            $error = 'your password not correct';
            return $this->apiResponse(null, false, $error);
        }
    }

}
