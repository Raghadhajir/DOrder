<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('isadmin');

    }

    public function index()
    {
        $PageTitle = 'Dashboard';
        $city = [];
        return view('panel.Dashboard.index',
            compact('PageTitle', 'city')
        );
    }

    public function notFound()
    {
        return view('error.404');
    }

    public function serverError()
    {
        return view('error.500');
    }
}
