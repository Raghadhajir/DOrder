<?php

use App\Http\Controllers\api\Addressapi;
use App\Http\Controllers\api\Adminapi;
use App\Http\Controllers\api\AllNotification;
use App\Http\Controllers\api\Areaapi;
use App\Http\Controllers\api\City;
use App\Http\Controllers\api\Cityapi;
use App\Http\Controllers\api\Customerapi;
use App\Http\Controllers\api\Deliveryapi;
use App\Http\Controllers\api\LoginApi;
use App\Http\Controllers\api\Monitorapi;
use App\Http\Controllers\api\Orderapi;
use App\Http\Controllers\api\Packageapi;
use App\Http\Controllers\api\RegisterApi;
use App\Http\Controllers\api\WorkTimeapi;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PackageController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//notification
Route::get('/notification/addcustomer', [AllNotification::class, 'AddCustomerNotify'])->name('notify-AddCustomer');
Route::get('/notification/addorder', [AllNotification::class, 'AddOrderNotify'])->name('notify-AddOrder');


Route::post('/login', [LoginApi::class, 'login'])->name('login');
Route::post('/register', [RegisterApi::class, 'register'])->name('register');

Route::middleware('auth:sanctum')->group(function () {

//cities
Route::get('/allcities', [Cityapi::class, 'allcities'])->name('allcities');
Route::get('/city/{id}', [Cityapi::class, 'city'])->name('city');

//areas
Route::get('/allareas', [Areaapi::class, 'allareas'])->name('allareas');
Route::get('/area/{id}', [Areaapi::class, 'area'])->name('area');

//admins
Route::get('/alladmins', [Adminapi::class, 'alladmins'])->name('alladmins');
// Route::get('/admin/{id}', [Adminapi::class, 'admin'])->name('admin');

//monitors
Route::get('/allmonitors', [Monitorapi::class, 'allmonitors'])->name('allmonitors');
Route::get('/monitor/{id}', [Monitorapi::class, 'monitor'])->name('monitor');


//deliver
Route::get('/alldeliveries', [Deliveryapi::class, 'alldeliveries'])->name('alldeliveries');
Route::get('/delivery/{id}', [Deliveryapi::class, 'delivery'])->name('delivery');


//packages
Route::get('/allpackages', [Packageapi::class, 'allpackages'])->name('allpackages');
Route::get('/package/{id}', [Packageapi::class, 'package'])->name('package');
//customers
Route::get('/allcustomers', [Customerapi::class, 'allcustomers'])->name('allcustomers');
Route::get('/customer/{id}', [Customerapi::class, 'customer'])->name('customer');


//work time
Route::get('/worktimes', [WorkTimeapi::class, 'worktimes'])->name('worktimes');
Route::get('/worktime/{id}', [WorkTimeapi::class, 'timebyid'])->name('timebyid');
Route::get('/worktimename/{name}', [WorkTimeapi::class, 'timebyname'])->name('timebyname');

//order
Route::post('/addorder', [Orderapi::class, 'addorder'])->name('addorder');
//send email
Route::get('/sendemail', [Orderapi::class, 'sendemail'])->name('sendemail');


//address
Route::get('/addresses/client',[Addressapi::class,'addressesForClient'])->name('addressesForClient');
});
