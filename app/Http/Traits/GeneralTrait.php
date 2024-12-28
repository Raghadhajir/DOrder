<?php

namespace App\Http\Traits;

use App\Models\ContactDetail;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

trait GeneralTrait
{
    public function apiResponse($data = null, bool $status = true, $error = null, $statusCode = 200)
    {
        $array = [
            'data' => $data,
            'status' => $status,
            'error' => $error,
            'statusCode' => $statusCode
        ];
        return response($array, $statusCode);

    }

    public function send_email($templateName, $email1, $subj, $order)
    {
        // try {


            Mail::send($templateName, $order, function ($message) use ($email1, $subj) {
                $message->to($email1)->subject($subj);
                // $message->from('biners.testing@gmail.com', 'Insurance');
            });

            return true;
        // } catch (\Swift_TransportException $e) {

        //     return false;
        // } catch (\Exception $e) {


        //     return $e;
        // }
    }

}


