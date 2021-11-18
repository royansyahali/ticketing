<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;

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
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route etiket

Route::get("/ticket/{limit?}", [TicketController::class, 'get'])->whereNumber('limit');
Route::post("/add-ticket", [TicketController::class, 'save']);
Route::patch("/reply-ticket", [TicketController::class, 'reply']);
Route::patch("/closed-ticket", [TicketController::class, 'closed']);
Route::delete("/delete-ticket", [TicketController::class, 'delete']);
