<?php

use App\Events\OrderStatusChanged;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\WorkingHoursController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SellersController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\DeliversController;
use App\Http\Controllers\SlidersController;

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
})->middleware('auth');
Route::get('/fire', function () {
    return view('test');
});

Route::get('/sender', function () {
    event(new OrderStatusChanged());

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('dashboard/sellers')->group(function () {
    Route::get('/', [SellersController::class, 'index']);
    Route::post('/insert', [SellersController::class, 'insert']);
    Route::get('/edit/{id}', [SellersController::class, 'edit']);
    Route::post('/update-account', [SellersController::class, 'updateAccount']);
    Route::post('/update-info', [SellersController::class, 'updateInfo']);
    Route::post('/update-password', [SellersController::class, 'updatePassword']);
    Route::post('/delete', [SellersController::class, 'delete']);
    Route::get('/logo/{file_name}', function ($filename) {
        $path = storage_path('app') . '/logos/' . $filename;
        $image = \File::get($path);
        $mime = \File::mimeType($path);
        return \Response::make($image, 200)->header('Content-Type', $mime);
    });
});

Route::prefix('dashboard/customers')->group(function () {
    Route::get('/', [CustomersController::class, 'index']);
    Route::get('/settings', [CustomersController::class, 'settings']);
    Route::get('/edit/{id}', [CustomersController::class, 'edit']);
    Route::post('/update-account', [CustomersController::class, 'updateAccount']);
    Route::post('/update-info', [CustomersController::class, 'updateInfo']);
    Route::post('/update-password', [CustomersController::class, 'updatePassword']);
    Route::post('/delete', [CustomersController::class, 'delete']);
    Route::post('/insert', [CustomersController::class, 'insert']);
    Route::get('/profile/{file_name}', function ($filename) {
        $path = storage_path('app') . '/profile/' . $filename;
        $image = \File::get($path);
        $mime = \File::mimeType($path);
        return \Response::make($image, 200)->header('Content-Type', $mime);
    });
});

Route::get('/dashboard/products', [ProductsController::class, 'listProducts']);
Route::post('/dashboard/products/add-product', [ProductsController::class, 'addProduct']);
Route::post('/dashboard/delete-product', [ProductsController::class, 'deleteProduct']);
Route::get('/dashboard/product/update-product-view/{id}', [ProductsController::class, 'updateProductView']);
Route::post('/dashboard/products/update-product/{id}', [ProductsController::class, 'updateProduct']);
Route::get('/dashboard/products/product-image/productImage/{file_name}', function ($filename) {
    $path = storage_path('app') . '/productImage/' . $filename;
    $image = \File::get($path);
    $mime = \File::mimeType($path);
    return \Response::make($image, 200)->header('Content-Type', $mime);
});

Route::prefix('dashboard/delivers')->group(function () {
    Route::get('/', [DeliversController::class, 'index']);
    Route::post('/insert', [DeliversController::class, 'insert']);
    Route::post('/delete', [DeliversController::class, 'delete']);
    Route::get('/edit/{id}', [DeliversController::class, 'edit']);
    Route::post('/update-info', [DeliversController::class, 'updateInfo']);
    Route::post('/update-password', [DeliversController::class, 'updatePassword']);
    Route::get('/profile/{file_name}', function ($filename) {
        $path = storage_path('app') . '/profilepictures/' . $filename;
        $image = \File::get($path);
        $mime = \File::mimeType($path);
        return \Response::make($image, 200)->header('Content-Type', $mime);
    });
});

Route::prefix('dashboard/sliders')->group(function () {
    Route::get('/', [SlidersController::class, 'index']);
    Route::post('/insert', [SlidersController::class, 'insert']);
    Route::get('/image/{file_name}', function ($filename) {
        $path = storage_path('app') . '/sliders/' . $filename;
        $image = \File::get($path);
        $mime = \File::mimeType($path);
        return \Response::make($image, 200)->header('Content-Type', $mime);
    });
});


//Categories
Route::get('/dashboard/categories', [CategoriesController::class, 'listCategories']);
Route::post('/dashboard/category/add-category', [CategoriesController::class, 'addProductCategory']);
Route::post('/dashboard/delete-category', [CategoriesController::class, 'deleteProductCategory']);
Route::get('/dashboard/category/update-category-view/{id}', [CategoriesController::class, 'showUpdateCategoryView']);
Route::post('/dashboard/category/update-category/{id}', [CategoriesController::class, 'updateCategory']);
Route::get('/dashboard/category/category-image/categoryImage/{file_name}', function ($filename) {
    $path = storage_path('app') . '/categoryImage/' . $filename;
    $image = \File::get($path);
    $mime = \File::mimeType($path);
    return \Response::make($image, 200)->header('Content-Type', $mime);

});

//Orders
Route::get('/dashboard/orders', [OrdersController::class, 'listOrders']);
Route::post('/dashboard/orders/add-order', [OrdersController::class, 'addOrder']);

//Discounts

Route::get('dashboard/discounts', function () {
    return view('dashboard.discounts.discount-product');
});

//Menu
Route::get('/dashboard/menu', [MenuController::class, 'listMenu']);
Route::post('/dashboard/menu/add-menu', [MenuController::class, 'addMenu']);
Route::get('/dashboard/menu/update-menu-view/{id}', [MenuController::class, 'showUpdateMenuView']);
Route::post('/dashboard/menu/update-menu/{id}', [MenuController::class, 'updateMenu']);
Route::post('/dashboard/delete-menu', [MenuController::class, 'deleteMenu']);

//Working Hours

Route::get('dashboard/working-hours', [WorkingHoursController::class, 'listWorkingHours']);
Route::post('dashboard/working-hour/add', [WorkingHoursController::class, 'addWorkingHours']);
Route::get('dashboard/working-hour/update-view/{id}', [WorkingHoursController::class, 'showUpdateWorkingHourView']);
Route::post('dashboard/working-hours/update/{id}', [WorkingHoursController::class, 'updateWorkingHours']);
Route::post('dashboard/delete-working-hours', [WorkingHoursController::class, 'deleteWorkingHours']);
