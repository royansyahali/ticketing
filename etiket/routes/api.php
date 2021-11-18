<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TiketController;

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

Route::get("/tiket/{limit?}", [TiketController::class, 'get'])->whereNumber('limit');
Route::post("/add-tiket", [TiketController::class, 'save']);
Route::patch("/reply-tiket", [TiketController::class, 'reply']);
Route::patch("/closed-tiket", [TiketController::class, 'closed']);
Route::delete("/delete-tiket", [TiketController::class, 'delete']);
