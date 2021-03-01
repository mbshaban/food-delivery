<?php

use App\Http\Controllers\CategoriesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SellersController;
use App\Http\Controllers\CustomersController;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('dashboard/sellers')->group(function () {
    Route::get('/', [SellersController::class, 'index']);
    Route::post('/insert', [SellersController::class, 'insert']);
    Route::get('/logo/{file_name}', function ($filename) {
	    $path = storage_path('app') . '/logos/' . $filename;
	    $image = \File::get($path);
	    $mime = \File::mimeType($path);
	    return \Response::make($image, 200)->header('Content-Type', $mime);
	});
});

Route::prefix('dashboard/customers')->group(function () {
    Route::get('/', [CustomersController::class, 'index']);
    Route::post('/insert', [CustomersController::class, 'insert']);
    Route::get('/profile/{file_name}', function ($filename) {
        $path = storage_path('app') . '/profile/' . $filename;
        $image = \File::get($path);
        $mime = \File::mimeType($path);
        return \Response::make($image, 200)->header('Content-Type', $mime);
    });
});

Route::get('dashboard/products/insert', function (){
 	return view('dashboard.products.insert');
});
Route::get('dashboard/products/insert', function () {
    return view('dashboard.products.insert');
});
Route::get('/dashboard/categories', [CategoriesController::class, 'listCategories']);

Route::post('/dashboard/category/add-category', [CategoriesController::class, 'addProductCategory']);

Route::get('/dashboard/category/category-image/categoryImage/{file_name}', function ($filename) {
    $path = storage_path('app') . '/categoryImage/' . $filename;
    $image = \File::get($path);
    $mime = \File::mimeType($path);
    return \Response::make($image, 200)->header('Content-Type', $mime);

});
