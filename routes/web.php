<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SellersController;
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

// -------------- dashboard ----------------
Route::get('dashboard', function () {
    return view('dashboard.index');
});


Route::prefix('dashboard/sellers')->group(function () {
    Route::get('/', [SellersController::class, 'index']);
    Route::post('/insert', [SellersController::class, 'insert']);
});

Route::get('dashboard/products/insert', function (){
	return view('dashboard.products.insert');
});
