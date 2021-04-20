<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\NotificationController;
use Illuminate\Http\Request;
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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('/register-user', [AuthController::class, 'register']);
Route::post('/check-user', [AuthController::class, 'checkUser']);
Route::get('/get-user', [AuthController::class, 'getUser']);
Route::post('/add-user-details', [AuthController::class, 'addUserDetails']);

//Route::group([
//    'middleware' => 'api',
//    'prefix' => 'auth'
//
//], function ($router) {
//    Route::post('/register-user', [AuthController::class, 'register']);
//    Route::get('/get-user', [AuthController::class, 'getUser']);
//    Route::post('/add-user-details', [AuthController::class, 'addUserDetails']);
//});

