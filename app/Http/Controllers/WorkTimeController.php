<?php

namespace App\Http\Controllers;

use App\Models\WorkTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class WorkTimeController extends Controller
{
    public function __construct()
    {
        $this->middleware('isadmin');

    }
    public function showworktime()
    {
        $times = WorkTime::all();
        return view('worktime.show', ['times' => $times]);
    }

    public function showeditworktime(Request $request)
    {
        $days = WorkTime::where('id', '=', $request->id)->first();
        return view('worktime.editworktime', ['days' => $days]);
    }
    public function showaddworktime(Request $request)
    {
        return view('worktime.addworktime');
    }
    public function addworktime(Request $request){
        $valid= Validator::make($request->all(), [
            'dateName' => 'required|string|in:الأحد,الاحد,الاثنين,الثلاثاء,الاربعاء,الخميس,الجمعة,السبت',
            'fromTime' => 'required',
            'toTime' => 'required'
        ]);
        if ($valid->fails()) {
            return back()->withErrors($valid)->withInput($request->all());
        }
        WorkTime::create([
            'dateName'=> $request->dateName,
            'fromTime' => $request->fromTime,
            'toTime' => $request->toTime
        ]);
        return redirect()->route('showworktime');

    }
    public function editworktime(Request $request)
    {
        // dd($request->id);
        $valid=Validator::make($request->all(), [
            'dateName' => 'required|string|in:الاحد,الاثنين,الثلاثاء,الاربعاء,الخميس,الجمعة,السبت,الأحد',
            'fromTime' => 'required',
            'toTime' => 'required'
        ]);
        if ($valid->fails()) {
            return back()->withErrors($valid)->withInput($request->all());
        }
        $day = WorkTime::find($request->id);
        // dd($day);

        $data = [
            'dateName' => $request->dateName,
            'fromTime' => $request->fromTime,
            'toTime' => $request->toTime
        ];

        $day->update($data);
        return redirect()->route('showworktime');


    }
}
