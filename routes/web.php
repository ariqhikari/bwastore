<?php

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

Route::get('/', 'HomeController@index')->name('home');

Route::get('/categories', 'CategoryController@index')->name('categories');
Route::get('/categories/{id}', 'CategoryController@detail')->name('categories.details');

Route::get('/details/{id}', 'DetailController@index')->name('details');
Route::post('/details/{id}', 'DetailController@add')->name('details.add');

Route::post('/checkout/callback', 'CheckoutController@callback')->name('checkout.callback');

Route::get('/success', 'CartController@success')->name('cart.success');

Route::get('/register/success', 'Auth\RegisterController@success')->name('register.success');

Route::middleware('auth')
    ->group(function(){
        Route::get('/cart', 'CartController@index')->name('cart');
        Route::delete('/cart/{id}', 'CartController@delete')->name('cart.delete');
        Route::post('/checkout', 'CheckoutController@process')->name('checkout');

        Route::prefix('dashboard')
            ->namespace('Dashboard')
            ->group(function () {
            Route::get('/', 'DashboardController@index')->name('dashboard');

            Route::get('/products', 'DashboardProductController@index')->name('dashboard.products');
            Route::post('/products', 'DashboardProductController@store')->name('dashboard.products.store');
            Route::get('/products/create', 'DashboardProductController@create')->name('dashboard.products.create');
            Route::get('/products/{id}', 'DashboardProductController@detail')->name('dashboard.products.detail');
            Route::put('/products/{id}', 'DashboardProductController@update')->name('dashboard.products.update');
            Route::post('/products/gallery/upload', 'DashboardProductController@uploadGallery')->name('dashboard.products.upload.gallery');
            Route::delete('/products/gallery/delete/{id}', 'DashboardProductController@deleteGallery')->name('dashboard.products.delete.gallery');
            
            Route::get('/transactions', 'DashboardTransactionController@index')->name('dashboard.transactions');
            Route::get('/transactions/{id}', 'DashboardTransactionController@detail')->name('dashboard.transactions.detail');
            Route::put('/transactions/{id}', 'DashboardTransactionController@update')->name('dashboard.transactions.update');

            Route::get('/settings', 'DashboardSettingController@store')->name('dashboard.settings.store');
            Route::get('/account', 'DashboardSettingController@account')->name('dashboard.settings.account');
            Route::put('/account/{redirect}', 'DashboardSettingController@update')->name('dashboard.settings.update');
        });
});

Route::prefix('admin')
    ->namespace('Admin')
    ->middleware(['auth', 'admin'])
    ->group(function () {
        Route::get('/', 'DashboardController@index')->name('admin.dashboard');
        Route::resource('category', 'CategoryController');
        Route::resource('user', 'UserController');
        Route::resource('product', 'ProductController');
        Route::resource('product-gallery', 'ProductGalleryController');
});


Auth::routes();