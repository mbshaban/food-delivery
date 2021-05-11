<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\MobileHomePageController;
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
// َ User
Route::post('/register-user', [AuthController::class, 'register']);
Route::post('/check-user', [AuthController::class, 'checkUser']);
Route::post('/login-user', [AuthController::class, 'login']);
Route::post('/forgot-password', [AuthController::class, 'updatePassword']);
Route::post('/add-user-details', [AuthController::class, 'addUserDetails']);


//Home
Route::get('/get-home-data/{customer_id}', [MobileHomePageController::class, 'getHomeData']);
Route::get('/image-file/sliders/{file_name}', function ($filename) {
    $path = storage_path('app') . '/sliders/' . $filename;
    $image = \File::get($path);
    $mime = \File::mimeType($path);
    return \Response::make($image, 200)->header('Content-Type', $mime);
});
Route::get('/image-file/categories/{file_name}', function ($filename) {
    $path = storage_path('app') . '/categoryImage/' . $filename;
    $image = \File::get($path);
    $mime = \File::mimeType($path);
    return \Response::make($image, 200)->header('Content-Type', $mime);
});
Route::get('/image-file/sellers/{file_name}', function ($filename) {
    $path = storage_path('app') . '/sellerImage/' . $filename;
    $image = \File::get($path);
    $mime = \File::mimeType($path);
    return \Response::make($image, 200)->header('Content-Type', $mime);
});
Route::get('/image-file/logo/{file_name}', function ($filename) {
    $path = storage_path('app') . '/logos/' . $filename;
    $image = \File::get($path);
    $mime = \File::mimeType($path);
    return \Response::make($image, 200)->header('Content-Type', $mime);
});
Route::get('/image-file/product-image/{file_name}', function ($filename) {
    $path = storage_path('app') . '/productImage/' . $filename;
    $image = \File::get($path);
    $mime = \File::mimeType($path);
    return \Response::make($image, 200)->header('Content-Type', $mime);
});
Route::get('/image-file/customer-image/{file_name}', function ($filename) {
    $path = storage_path('app') . '/customerImage/' . $filename;
    $image = \File::get($path);
    $mime = \File::mimeType($path);
    return \Response::make($image, 200)->header('Content-Type', $mime);
});

Route::get('get-restaurant-by-category/{category_id}',[MobileHomePageController::class,'getRestaurantByCategory']);
Route::get('get-restaurant-details/{restaurant_id}',[MobileHomePageController::class,'getRestaurantDetails']);
Route::post('add-customer-address',[MobileHomePageController::class,'addCustomerAddress']);
Route::get('get-customer-address/{customer_id}',[MobileHomePageController::class,'getCustomerAddress']);
Route::post('update-customer/{customer_id}',[MobileHomePageController::class,'updateCustomer']);
Route::get('get-customer/{customer_id}',[MobileHomePageController::class,'getCustomer']);
//Route::group(['middleware' => ['jwtVerify']], function () {
//    Route::get('/get-home-data', [MobileHomePageController::class, 'getHomeData']);
//});
