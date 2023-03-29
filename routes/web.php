<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/login', function () {
    return view('auth.login');
});
Route::get('/home/{type}', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/needs/{type}', [App\Http\Controllers\HomeController::class, 'needIndex'])->name('need');
Route::get('/jobs', [App\Http\Controllers\HomeController::class, 'jobIndex'])->name('job');
Route::get('/my/need/requests/', [App\Http\Controllers\HomeController::class, 'needRequests'])->name('need_requests');
Route::get('/petadoptions', [App\Http\Controllers\HomeController::class, 'petAdoptionIndex'])->name('petadoption');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/aydinlatma-metni', function () {
    return view('aydinlatmabelgesi');
});
Route::get('/nasil-kullanirim', function () {
    return view('howtouse');
});
Route::get('/misafir-ol-nedir', function () {
    return view('misafirolprojesi');
});
Route::get('/destek-kanalları', function () {
    return view('supportchannels');
});
Route::get('post/detail/{id}', [\App\Http\Controllers\PostController::class, 'detail']);
Route::get('need/detail/{id}', [\App\Http\Controllers\NeedController::class, 'detail']);
Route::get('jobs/detail/{id}', [\App\Http\Controllers\JobController::class, 'detail']);
Route::get('petadoption/detail/{id}', [\App\Http\Controllers\PetAdoptionController::class, 'detail']);
Route::get('otpTest/{msg}', [\App\Http\Controllers\PostController::class, 'sendOTP']);
Route::get('post/getPosts/{type}', [\App\Http\Controllers\PostController::class, 'getPostsByType'])->name('posts.list');
Route::get('need/getNeeds', [\App\Http\Controllers\NeedController::class, 'getNeeds'])->name('needs.list');

Auth::routes();

Route::middleware(['auth'])->group(function () {

    Route::group(['prefix' => 'ticket'], function () {
       Route::get('list', [TicketController::class, 'list']);
       Route::get('add', [TicketController::class, 'add']);
       Route::post('add', [TicketController::class, 'create']);
       Route::get('detail/{id}', [TicketController::class, 'detail']);
       Route::patch('edit/{id}', [TicketController::class, 'update']);
    });

    Route::group(['prefix' => 'client'], function () {
        Route::get('add', [ClientController::class, 'add']);
        Route::post('add', [ClientController::class, 'create']);
        Route::get('list', [ClientController::class, 'list']);
        Route::get('delete/{id}', [ClientController::class, 'delete']);
        Route::get('edit/{id}', [ClientController::class, 'edit']);
        Route::patch('edit/{id}', [ClientController::class, 'update']);
    });

    Route::group(['prefix' => 'post'], function () {
        Route::get('add', [\App\Http\Controllers\PostController::class, 'add']);
        Route::post('add', [\App\Http\Controllers\PostController::class, 'create']);
        Route::get('list', [\App\Http\Controllers\PostController::class, 'list']);
        Route::patch('edit/{id}', [\App\Http\Controllers\PostController::class, 'update']);
        Route::get('close/{id}', [\App\Http\Controllers\PostController::class, 'close']);
    });

    Route::group(['prefix' => 'need'], function () {
        Route::get('add', [\App\Http\Controllers\NeedController::class, 'add']);
        Route::post('add', [\App\Http\Controllers\NeedController::class, 'create']);
        Route::get('list', [\App\Http\Controllers\NeedController::class, 'list']);
        Route::get('close/{id}', [\App\Http\Controllers\NeedController::class, 'close']);
    });

    Route::group(['prefix' => 'need/request'], function () {
        Route::get('add/{post_id}', [\App\Http\Controllers\NeedRequestController::class, 'add']);
        Route::post('add', [\App\Http\Controllers\NeedRequestController::class, 'create']);
        Route::get('get/{id}', [\App\Http\Controllers\NeedRequestController::class, 'getRequests']);
        Route::get('list', [\App\Http\Controllers\NeedRequestController::class, 'list']);
    });

    Route::group(['prefix' => 'jobs'], function () {
        Route::get('add', [\App\Http\Controllers\JobController::class, 'add']);
        Route::post('add', [\App\Http\Controllers\JobController::class, 'create']);
        Route::get('list', [\App\Http\Controllers\JobController::class, 'list']);
        Route::get('close/{id}', [\App\Http\Controllers\JobController::class, 'close']);
    });

    Route::group(['prefix' => 'jobs/request'], function () {
        Route::get('add/{post_id}', [\App\Http\Controllers\JobRequestController::class, 'add']);
        Route::post('add', [\App\Http\Controllers\JobRequestController::class, 'create']);
        Route::get('get/{id}', [\App\Http\Controllers\JobRequestController::class, 'getRequests']);
        Route::get('list', [\App\Http\Controllers\JobRequestController::class, 'list']);
    });


    Route::group(['prefix' => 'petadoption'], function () {
        Route::get('add', [\App\Http\Controllers\PetAdoptionController::class, 'add']);
        Route::post('add', [\App\Http\Controllers\PetAdoptionController::class, 'create']);
        Route::get('list', [\App\Http\Controllers\PetAdoptionController::class, 'list']);
        Route::get('close/{id}', [\App\Http\Controllers\PetAdoptionController::class, 'close']);
    });

    Route::group(['prefix' => 'petadoption/request'], function () {
        Route::get('add/{post_id}', [\App\Http\Controllers\PetAdoptionRequestController::class, 'add']);
        Route::post('add', [\App\Http\Controllers\PetAdoptionRequestController::class, 'create']);
        Route::get('get/{id}', [\App\Http\Controllers\PetAdoptionRequestController::class, 'getRequests']);
        Route::get('list', [\App\Http\Controllers\PetAdoptionRequestController::class, 'list']);
    });

    Route::group(['prefix' => 'request'], function () {
        Route::get('add/{post_id}', [\App\Http\Controllers\RequestController::class, 'add']);
        Route::post('add', [\App\Http\Controllers\RequestController::class, 'create']);
        Route::get('get/{id}', [\App\Http\Controllers\RequestController::class, 'getRequests']);
        Route::get('list', [\App\Http\Controllers\RequestController::class, 'list']);
    });

    Route::post('send', [\App\Http\Controllers\SmsController::class, 'send']);
    Route::post('checkOtp', [\App\Http\Controllers\SmsController::class, 'checkOtp']);
    Route::get('sendAllUsers/{type}', [\App\Http\Controllers\SmsController::class, 'sendSmsToAllUsersByType']);

    Route::group(['prefix' => 'user'], function() {
       Route::get('list', [\App\Http\Controllers\UserController::class, 'list']);
       Route::get('detail/{id}', [\App\Http\Controllers\UserController::class, 'detail']);
       Route::post('nviCheck', [\App\Http\Controllers\UserController::class, 'nviCheck']);
       Route::post('edit/{id}', [\App\Http\Controllers\UserController::class, 'update']);
    });
});
