<?php

use App\Http\Controllers\CategoriesController;
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

// -------------- dashboard ----------------
Route::get('dashboard', function () {
    return view('dashboard.index');
});

Route::get('dashboard/sellers', function () {
    return view('dashboard.sellers.sellers');
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
