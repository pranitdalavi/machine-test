<?php

use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return redirect('/login',301);
});


Route::get('/login', ['App\Http\Controllers\Auth\AuthController', 'index'])->name('login');
Route::post('/post-login', ['App\Http\Controllers\Auth\AuthController', 'postLogin'])->name('login.post');
Route::get('/registration', ['App\Http\Controllers\Auth\AuthController', 'registration'])->name('registration');
Route::post('/post-registration', ['App\Http\Controllers\Auth\AuthController', 'postRegistration'])->name('register.post');
Route::get('/logout', ['App\Http\Controllers\Auth\AuthController', 'logout'])->name('logout');


Route::group(['middleware' => ['auth']], function () {
    //Create form
    Route::get('/personal-details', ['App\Http\Controllers\TestController', 'createForm'])->name('personal-details');
    Route::post('/store-personal-details', ['App\Http\Controllers\TestController', 'storePersonalDetails'])->name('store-personal-details');
    Route::delete('/delete-personal-details/{id}', ['App\Http\Controllers\TestController', 'deletePersonalDetails'])->name('delete-personal-details.deletePersonalDetails');

    //Get Public IP Address
    Route::get('/public-ip-address', ['App\Http\Controllers\TestController', 'publicIpAddress'])->name('public-ip-address');
    Route::post('/ip-address', ['App\Http\Controllers\TestController', 'IpAddress'])->name('ip-address');


    //Get records and store in excel
    Route::get('/get-records', ['App\Http\Controllers\TestController', 'getRecords'])->name('getRecords');
    Route::post('/store-records-in-excel', ['App\Http\Controllers\TestController', 'storeRecords'])->name('store-records-in-excel');

    //Send E-mail
    Route::get('/email', ['App\Http\Controllers\TestController', 'emailForm'])->name('email');
    Route::post('/email', ['App\Http\Controllers\TestController', 'sendMail'])->name('email');
    // Route::resource('machinetest', TestController::class);
});
