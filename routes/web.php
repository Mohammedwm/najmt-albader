<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\ConstantController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FeatureController;
use App\Http\Controllers\Admin\GeneralInfoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\WorkController;
use App\Http\Controllers\Admin\WorkerController;
use App\Http\Controllers\DetailController;
use Carbon\Carbon;
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

Route::get('/test',function () {
    dd(uniqid());
});

Route::get('/login',[LoginController::class, 'index'])->name('login');
Route::post('/submit',[LoginController::class, 'login'])->name('login.check');
Route::get('/',[HomeController::class, 'index'])->name('home');

Route::get('/details/{constant_id}',[DetailController::class, 'index'])->name('details');
Route::post('booking-worker', [DetailController::class, 'bookingWorker'])->name('booking-worker');
Route::get('/booking-follow/{follow_url}',[DetailController::class, 'bookingFollow'])->name('booking-follow');

Route::group(['middleware' => ['auth']],function(){
    Route::get('/dashboard',[DashboardController::class, 'index'])->name('dashboard.home');

    Route::resource('categories',CategoryController::class)->only([
        'index','create','edit','destroy','store','update'
    ]);
    Route::resource('works',WorkController::class)->only([
        'index','create','edit','destroy','store','update'
    ]);
    Route::resource('workers',WorkerController::class)->only([
        'index','create','edit','destroy','store','update'
    ]);
    Route::resource('constants',ConstantController::class)->only([
        'index','create','edit','destroy','store','update'
    ]);
    Route::resource('features',FeatureController::class)->only([
        'index','create','edit','destroy','store','update'
    ]);
    Route::resource('comments',CommentController::class)->only([
        'index','create','edit','destroy','store','update'
    ]);

    Route::resource('bookings',BookingController::class)->only([
        'index','edit','update'
    ]);

    Route::get('/getConstantDtl/{constant_id}',[ConstantController::class, 'getConstantDtl'])->name('constants.getConstantDtl');
    Route::post('constants/changeStatus',[ConstantController::class, 'changeStatus'])->name('constants.changeStatus');

    Route::get('account-settings',[GeneralInfoController::class, 'accountSettings'])->name('account_settings');
    Route::post('update-account', [GeneralInfoController::class, 'updateAccount'])->name('update_account');
    Route::post('change-password', [GeneralInfoController::class, 'changePassword'])->name('change_password');
});
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
