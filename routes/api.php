<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('auth')->group(function () {
    Route::post('/login',App\Http\Controllers\V1\Auth\LoginController::class);
    Route::get('/permissions',App\Http\Controllers\V1\Auth\PermissionsController::class)->middleware(['auth:user','scope:user']);
});

Route::prefix('backoffice')->middleware(['auth:user','scope:user'])->group(function () {
    Route::prefix('users')->as('users:')->group(function () {
        Route::get(
            '/',
            App\Http\Controllers\V1\Backoffice\Users\IndexController::class
        )->middleware('permission:user-list')->name('index');

        Route::get(
            '/{id}',
            App\Http\Controllers\V1\Backoffice\Users\ShowController::class
        )->middleware('permission:user-list')->name('show');

        Route::put(
            '/{user}',
            App\Http\Controllers\V1\Backoffice\Users\UpdateController::class
        )->middleware('permission:user-edit')->name('edit');

        Route::post(
            '/',
            App\Http\Controllers\V1\Backoffice\Users\StoreController::class
        )->middleware('permission:user-create')->name('create');

        Route::delete(
            '/{user}',
            App\Http\Controllers\V1\Backoffice\Users\DestroyController::class
        )->middleware('permission:user-delete')->name('delete');
    });

    Route::prefix('clients')->as('clients:')->group(function () {
        Route::get(
            '/',
            App\Http\Controllers\V1\Backoffice\Clients\IndexController::class
        )->middleware('permission:user-list')->name('index');

        Route::post(
            '/',
            App\Http\Controllers\V1\Backoffice\Clients\StoreController::class
        )->middleware('permission:user-create')->name('create');

        Route::delete(
            '/{user}',
            App\Http\Controllers\V1\Backoffice\Clients\DestroyController::class
        )->middleware('permission:user-delete')->name('delete');


    });

    Route::prefix('roles')->as('roles:')->group(function () {
        Route::get(
            '/',
            \App\Http\Controllers\V1\Backoffice\Roles\IndexController::class
        )->middleware('permission:role-list')->name('index');

        Route::get(
            '/{role}',
            \App\Http\Controllers\V1\Backoffice\Roles\ShowController::class
        )->middleware('permission:role-list')->name('show');

        Route::post(
            '/',
            \App\Http\Controllers\V1\Backoffice\Roles\StoreController::class
        )->middleware('permission:role-create')->name('store');

        Route::put(
            '/{role}',
            \App\Http\Controllers\V1\Backoffice\Roles\UpdateController::class
        )->middleware('permission:role-edit')->name('update');

        Route::delete(
            '/{role}',
            \App\Http\Controllers\V1\Backoffice\Roles\DestroyController::class
        )->middleware('permission:role-delete')->name('delete');
    });

    Route::prefix('permissions')->as('permissions:')->group(function () {
        Route::get(
            '/',
            \App\Http\Controllers\V1\Backoffice\Permissions\IndexController::class
        )->middleware('permission:permission-list')->name('index');

        Route::get(
            '/{permission}',
            \App\Http\Controllers\V1\Backoffice\Permissions\ShowController::class
        )->middleware('permission:permission-list')->name('show');

        Route::post(
            '/',
            \App\Http\Controllers\V1\Backoffice\Permissions\StoreController::class
        )->middleware('permission:permission-create')->name('store');

        Route::put(
            '/{permission}',
            \App\Http\Controllers\V1\Backoffice\Permissions\UpdateController::class
        )->middleware('permission:permission-edit')->name('update');

        Route::delete(
            '/{permission}',
            \App\Http\Controllers\V1\Backoffice\Permissions\DestroyController::class
        )->middleware('permission:permission-delete')->name('delete');
    });

    Route::prefix('brands')->as('brands:')->group(function () {
        Route::get(
            '/',
            App\Http\Controllers\V1\Backoffice\Brands\IndexController::class
        )->middleware('permission:brand-list')->name('index');

        // Route::get(
        //     '/{id}',
        //     App\Http\Controllers\V1\Backoffice\Brands\ShowController::class
        // )->middleware('permission:brand-list')->name('show');

        Route::put(
            '/{brand}',
            App\Http\Controllers\V1\Backoffice\Brands\UpdateController::class
        )->middleware('permission:brand-edit')->name('edit');

        Route::post(
            '/',
            App\Http\Controllers\V1\Backoffice\Brands\StoreController::class
        )->middleware('permission:brand-create')->name('create');

        Route::delete(
            '/{brand}',
            App\Http\Controllers\V1\Backoffice\Brands\DestroyController::class
        )->middleware('permission:brand-delete')->name('delete');
    });

    Route::prefix('offers')->as('offers:')->group(function () {
        Route::get(
            '/',
            App\Http\Controllers\V1\Backoffice\Offers\IndexController::class
        )->middleware('permission:offer-list')->name('index');

        // Route::get(
        //     '/{id}',
        //     App\Http\Controllers\V1\Backoffice\Brands\ShowController::class
        // )->middleware('permission:brand-list')->name('show');

        Route::put(
            '/{offer}',
            App\Http\Controllers\V1\Backoffice\Offers\UpdateController::class
        )->middleware('permission:offer-edit')->name('edit');

        Route::post(
            '/',
            App\Http\Controllers\V1\Backoffice\Offers\StoreController::class
        )->middleware('permission:offer-create')->name('create');

        Route::delete(
            '/{offer}',
            App\Http\Controllers\V1\Backoffice\Offers\DestroyController::class
        )->middleware('permission:offer-delete')->name('delete');



        Route::delete(
            '/{offer}/delete_product/{product_id}',
            App\Http\Controllers\V1\Backoffice\Offers\DestroyProductController::class
        )->middleware('permission:offer-delete')->name('delete.product');

    });

    Route::prefix('categories')->as('categories:')->group(function () {
        Route::get(
            '/',
            App\Http\Controllers\V1\Backoffice\Categories\IndexController::class
        )->middleware('permission:category-list')->name('index');

        Route::put(
            '/{category}',
            App\Http\Controllers\V1\Backoffice\Categories\UpdateController::class
        )->middleware('permission:category-edit')->name('edit');

        Route::post(
            '/',
            App\Http\Controllers\V1\Backoffice\Categories\StoreController::class
        )->middleware('permission:category-create')->name('create');

        Route::delete(
            '/{category}',
            App\Http\Controllers\V1\Backoffice\Categories\DestroyController::class
        )->middleware('permission:category-delete')->name('delete');;
    });

    Route::prefix('products')->as('products:')->group(function () {
        Route::get(
            '/',
            App\Http\Controllers\V1\Backoffice\Products\IndexController::class
        )->middleware('permission:product-list')->name('index');

        Route::get(
            '/list',
            App\Http\Controllers\V1\Backoffice\Products\ListController::class
        )->middleware('permission:product-list')->name('list');


        Route::delete(
            '/image/{id}',
            App\Http\Controllers\V1\Backoffice\Products\DeleteImageController::class
        )->middleware('permission:product-edit')->name('delete:image');

        Route::get(
            '/{id}',
            App\Http\Controllers\V1\Backoffice\Products\ShowController::class
        )->middleware('permission:product-list')->name('show');

        Route::put(
            '/{product}',
            App\Http\Controllers\V1\Backoffice\Products\UpdateController::class
        )->middleware('permission:product-edit')->name('edit');

        Route::delete(
            '/{product}',
            App\Http\Controllers\V1\Backoffice\Products\DestroyController::class
        )->middleware('permission:product-delete')->name('delete');

        Route::post(
            '/',
            App\Http\Controllers\V1\Backoffice\Products\StoreController::class
        )->middleware('permission:product-create')->name('create');
    });

    Route::prefix('orders')->as('orders:')->group(function () {
        Route::get(
            '/',
            App\Http\Controllers\V1\Backoffice\Orders\IndexController::class
        )->middleware('permission:order-list')->name('index');

        Route::get(
            '/{id}',
            App\Http\Controllers\V1\Backoffice\Orders\ShowController::class
        )->middleware('permission:order-list')->name('show');

        Route::delete(
            '/{order}',
            App\Http\Controllers\V1\Backoffice\Orders\DestroyController::class
        )->middleware('permission:order-delete')->name('delete');


        Route::put(
            '/{order}',
            App\Http\Controllers\V1\Backoffice\Orders\UpdateController::class
        )->middleware('permission:order-edit')->name('edit');

        Route::post(
            '/checkout',
            App\Http\Controllers\V1\Backoffice\Orders\CheckoutController::class
        )->name('checkout');

    });

    Route::prefix('statistic')->as('statistic:')->group(function () {
        Route::get(
            '/summary',
            App\Http\Controllers\V1\Backoffice\Statistic\SummaryController::class
        )->middleware('permission:statistic-summary')->name('summary');
    });



    Route::post('/upload_images',App\Http\Controllers\V1\Backoffice\Images\UplaodController::class);

});


Route::prefix('categories')->group(function () {
    Route::get('/',App\Http\Controllers\V1\Client\Categories\IndexController::class);
    Route::get('/{category}',App\Http\Controllers\V1\Client\Categories\ShowController::class);
});

Route::prefix('products')->group(function () {
    Route::get('/',App\Http\Controllers\V1\Client\Products\IndexController::class);
    Route::get('/{product}',App\Http\Controllers\V1\Client\Products\ShowController::class);
});

Route::prefix('brands')->group(function () {
    Route::get('/',App\Http\Controllers\V1\Client\Brands\IndexController::class);
    // Route::get('/{id}',App\Http\Controllers\V1\Client\Products\ShowController::class);
});

Route::post('/checkout',App\Http\Controllers\V1\Client\CheckoutController::class);



Route::post('/auth/client/login',App\Http\Controllers\V1\Auth\Client\LoginController::class);
Route::post('/auth/client/register',App\Http\Controllers\V1\Auth\Client\RegisterController::class);
Route::put('/auth/client/update',App\Http\Controllers\V1\Auth\Client\UpdateController::class)->middleware(['auth:user','scope:client']);;
Route::get('/auth/users',App\Http\Controllers\V1\Auth\UsersController::class);

