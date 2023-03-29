<?php

use App\Http\Controllers\Api\TicketController;
use App\Http\Controllers\Api\BlogController;
use App\Models\Ticket;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::apiResource('tickets', TicketController::class);
Route::get('ticket/{id}', function ($id) {
    $ticket = Ticket::find($id);

    return response()->json([
        'status' => true,
        'data' => $ticket
    ], 200);
});
Route::get('tickets/filter/{type}', [TicketController::class, 'filter']);

Route::resource('blogs', BlogController::class);
