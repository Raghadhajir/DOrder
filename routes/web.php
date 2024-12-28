<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MainPageController;
use App\Http\Controllers\MonitorController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\WorkTimeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

\Illuminate\Support\Facades\Auth::routes(['register' => false]);


// Custom Auth
Route::get('/login', [LoginController::class, 'show_login_form'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::get('/register', [LoginController::class, 'show_signup_form'])->name('register');
Route::post('/register', [LoginController::class, 'process_signup']);

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');



//Auth::routes();
Route::prefix('admin')->middleware(['isadmin'])->group(function () {
    Route::get('/test', [DashboardController::class, 'index'])->name('Admin-Panel');

    //cities
    Route::get('/showcities', [CityController::class, 'showcities'])->name('showcities');

    Route::get('/addcity', [CityController::class, 'showaddcity'])->name('addcity');
    Route::post('/addcity', [CityController::class, 'addcity']);

    Route::get('/editcity', [CityController::class, 'showeditcity'])->name('showeditcity');
    Route::post('/editcity', [CityController::class, 'editcity']);


    Route::get('/deletecity', [CityController::class, 'deletecity'])->name('deletecity');
    Route::get('/citytrash', [CityController::class, 'deleted'])->name('deletedcity');
    Route::get('/restorecity', [CityController::class, 'restore'])->name('restorecity');

    //areas
    Route::get('/showareas', [AreaController::class, 'showareas'])->name('showareas');

    Route::get('/addarea', [AreaController::class, 'showaddarea'])->name('addarea');
    Route::post('/addarea', [AreaController::class, 'addarea']);

    Route::get('/editarea', [AreaController::class, 'showeditarea'])->name('showeditarea');
    Route::post('/editarea', [AreaController::class, 'editarea']);

    Route::get('/deletearea', [AreaController::class, 'deletearea'])->name('deletearea');
    Route::get('/areatrach', [AreaController::class, 'deleted'])->name('deletedarea');
    Route::get('/restorearea', [AreaController::class, 'restore'])->name('restorearea');
    //work time
    Route::get('/showworktime', [WorkTimeController::class, 'showworktime'])->name('showworktime');

    Route::get('/editworktime', [WorkTimeController::class, 'showeditworktime'])->name('showeditworktime');
    Route::post('/editworktime', [WorkTimeController::class, 'editworktime']);

    Route::get('/addworktime', [WorkTimeController::class, 'showaddworktime'])->name('showaddworktime');
    Route::post('/addworktime', [WorkTimeController::class, 'addworktime']);

    //monitor
    Route::get('/showmonitors', [MonitorController::class, 'showmonitors'])->name('showmonitors');

    Route::get('/addmonitor', [MonitorController::class, 'showaddmonitor'])->name('showaddmonitor');
    Route::post('/addmonitor', [MonitorController::class, 'addmonitor']);
    Route::get('/areas/{cityId}', [MonitorController::class, 'getAreas']);

    Route::get('/editmonitor', [MonitorController::class, 'showeditmonitor'])->name('showeditmonitor');
    Route::post('/editmonitor', [MonitorController::class, 'editmonitor'])->name('editmonitor');
    Route::get('/monitornotactive', [MonitorController::class, 'notactive'])->name('monitornotactive');
    Route::get('/activemonitor', [MonitorController::class, 'activemonitor'])->name('activemonitor');

    //admin
    Route::get('/showadmins', [AdminController::class, 'showadmins'])->name('showadmins');

    Route::get('/addadmin', [AdminController::class, 'showaddadmin'])->name('showaddadmin');
    Route::post('/addadmin', [AdminController::class, 'addadmin']);

    Route::get('/editadmin', [AdminController::class, 'showeditadmin'])->name('showeditadmin');
    Route::post('/editadmin', [AdminController::class, 'editadmin']);
    Route::get('/adminnotactive', [AdminController::class, 'notactive'])->name('adminnotactive');
    Route::get('/activeadmin', [AdminController::class, 'activeadmin'])->name('activeadmin');

    //delivary
    Route::get('/showdeliveries', [DeliveryController::class, 'showdeliveries'])->name('showdeliveries');

    Route::get('/adddelivery', [DeliveryController::class, 'showadddelivery'])->name('showadddelivery');
    Route::post('/adddelivery', [DeliveryController::class, 'adddelivery']);

    Route::get('/editdelivery', [DeliveryController::class, 'showeditdelivery'])->name('showeditdelivery');
    Route::post('/editdelivery', [DeliveryController::class, 'editdelivery']);
    Route::get('/delivernotactive', [DeliveryController::class, 'delivernotactive'])->name('delivernotactive');
    Route::get('/activatedeliver', [DeliveryController::class, 'activatedeliver'])->name('activatedeliver');

    //customer
    Route::get('/showcustomer', [CustomerController::class, 'showcustomer'])->name('showcustomer');
    Route::get('/customernotactive', [CustomerController::class, 'customernotactive'])->name('customernotactive');
    Route::get('/activecustomer', [CustomerController::class, 'activecustomer'])->name('activecustomer');
    Route::get('/notactivecustomer', [CustomerController::class, 'notactivecustomer'])->name('notactivecustomer');

    Route::get('/addcustomer', [CustomerController::class, 'showaddcustomer'])->name('showaddcustomer');
    Route::post('/addcustomer', [CustomerController::class, 'addcustomer']);

    Route::get('/detailscustomer', [CustomerController::class, 'detailscustomer'])->name('detailscustomer');

    Route::post('/addpackageforclient', [CustomerController::class, 'addpackageforclient'])->name('addpackageforclient');
    Route::post('/addsupscripeforclient', [CustomerController::class, 'add_supscripe_for_client'])->name('add_supscripe_for_client');
    Route::post('/addaddressforclient', [AddressController::class, 'add_address_for_client'])->name('add_address_for_client');
    Route::get('/deleteaddress', [AddressController::class, 'deleteaddress'])->name('deleteaddress');



    //package
    Route::get('/showpackage', [PackageController::class, 'showpackage'])->name('showpackage');

    Route::get('/addpackage', [PackageController::class, 'showaddpackage'])->name('showaddpackage');
    Route::post('/addpackage', [PackageController::class, 'addpackage']);

    Route::get('/editpackage', [PackageController::class, 'showeditpackage'])->name('showeditpackage');
    Route::post('/editpackage', [PackageController::class, 'editpackage']);


    Route::get('/deletepackage', [PackageController::class, 'deletepackage'])->name('deletepackage');

    //order
    Route::get('/showorders', [OrderController::class, 'showorders'])->name('showorders');
    Route::get('/openorder', [OrderController::class, 'openorder'])->name('openorder');

    Route::post('/addDelivaryman', [OrderController::class, 'addDelivaryman'])->name('addDelivaryman');

    Route::get('/addorder', [OrderController::class, 'showaddorder'])->name('showaddorder');
    Route::post('/addorder', [OrderController::class, 'addorder']);

    Route::get('/AddAddress', [OrderController::class, 'addAddress'])->name('AddAddress');

    //mainpage
    Route::get('/showmainpage', [MainPageController::class, 'showmainpage'])->name('mainpage');
    Route::post('/getorder', [MainPageController::class, 'getorder'])->name('getorder');
    Route::post('/checkclients', [MainPageController::class, 'checkclients'])->name('checkclients');
    Route::get('/TodaysOrders', [MainPageController::class, 'TodaysOrders'])->name('TodaysOrders');









});

Route::get('/404', [DashboardController::class, 'notFound'])->name('404');
Route::get('/500', [DashboardController::class, 'serverError'])->name('404');

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/', function () {
    return view('welcome');
});



