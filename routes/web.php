<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\PointsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ChatsController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;    
use App\Http\Controllers\SellersController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AppsettingsController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\VerificationsController;
use App\Http\Controllers\ProfessionsController;
use App\Http\Controllers\TransactionsController;
use App\Http\Controllers\BulkUserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;



Route::get('/', function () {
    return redirect('/admin');
});

Auth::routes();



Route::namespace('Auth')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/register', 'RegisterController@showRegistrationForm')->name('register');
    Route::post('/register', 'RegisterController@register');

    Route::get('/password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('/password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('/password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('/password/reset', 'ResetPasswordController@reset');
});
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingController::class, 'store'])->name('settings.store');


    //User
    Route::get('/users', [UsersController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UsersController::class, 'create'])->name('users.create');
    Route::get('/users/{users}/edit', [UsersController::class, 'edit'])->name('users.edit');
    Route::delete('/users/{users}', [UsersController::class, 'destroy'])->name('users.destroy');
    Route::put('/users/{users}', [UsersController::class, 'update'])->name('users.update');
    Route::post('/users', [UsersController::class, 'store'])->name('users.store');
    Route::get('/users/{id}/add-points', [UsersController::class, 'addPointsForm'])->name('users.add_points');
    Route::post('/users/{id}/add-points', [UsersController::class, 'addPoints'])->name('users.store_points');


   
     //products  
     Route::get('/products', [ProductsController::class, 'index'])->name('products.index');
     Route::get('/products/create', [ProductsController::class, 'create'])->name('products.create');
     Route::get('/products/{products}/edit', [ProductsController::class, 'edit'])->name('products.edit');
     Route::delete('/products/{products}', [ProductsController::class, 'destroy'])->name('products.destroy');
     Route::put('/products/{products}', [ProductsController::class, 'update'])->name('products.update');
     Route::post('/products', [ProductsController::class, 'store'])->name('products.store');
     Route::post('/products/updateStatus', [ProductsController::class, 'updateStatus'])->name('products.updateStatus');
     Route::post('/products/sendNotification', [ProductsController::class, 'sendNotification'])->name('products.sendNotification');


      //Chats  
      Route::get('/sellers', [SellersController::class, 'index'])->name('sellers.index');
      Route::get('/sellers/create', [SellersController::class, 'create'])->name('sellers.create');
      Route::get('/sellers/{sellers}/edit', [SellersController::class, 'edit'])->name('sellers.edit');
      Route::delete('/sellers/{sellers}', [SellersController::class, 'destroy'])->name('sellers.destroy');
      Route::put('/sellers/{sellers}', [SellersController::class, 'update'])->name('sellers.update');
      Route::post('/sellers', [SellersController::class, 'store'])->name('sellers.store');

     //Chats  
     Route::get('/chats', [ChatsController::class, 'index'])->name('chats.index');
     Route::get('/chats/create', [ChatsController::class, 'create'])->name('chats.create');
     Route::get('/chats/{chats}/edit', [ChatsController::class, 'edit'])->name('chats.edit');
     Route::delete('/chats/{chats}', [ChatsController::class, 'destroy'])->name('chats.destroy');
     Route::put('/chats/{chats}', [ChatsController::class, 'update'])->name('chats.update');
     Route::post('/chats', [ChatsController::class, 'store'])->name('chats.store');

      //Points  
      Route::get('/points', [PointsController::class, 'index'])->name('points.index');
      Route::get('/points/create', [PointsController::class, 'create'])->name('points.create');
      Route::get('/points/{points}/edit', [PointsController::class, 'edit'])->name('points.edit');
      Route::delete('/points/{points}', [PointsController::class, 'destroy'])->name('points.destroy');
      Route::put('/points/{points}', [PointsController::class, 'update'])->name('points.update');
      Route::post('/points', [PointsController::class, 'store'])->name('points.store');

       //customers  
       Route::get('/customers', [CustomersController::class, 'index'])->name('customers.index');
       Route::delete('/customers/{customers}', [CustomersController::class, 'destroy'])->name('customers.destroy');


        //Notifications  
        Route::get('/notifications', [NotificationsController::class, 'index'])->name('notifications.index');
        Route::get('/notifications/create', [NotificationsController::class, 'create'])->name('notifications.create');
        Route::get('/notifications/{notifications}/edit', [NotificationsController::class, 'edit'])->name('notifications.edit');
        Route::delete('/notifications/{notifications}', [NotificationsController::class, 'destroy'])->name('notifications.destroy');
        Route::put('/notifications/{notifications}', [NotificationsController::class, 'update'])->name('notifications.update');
        Route::post('/notifications', [NotificationsController::class, 'store'])->name('notifications.store');


        
        //Professions  
        Route::get('/professions', [ProfessionsController::class, 'index'])->name('professions.index');
        Route::get('/professions/create', [ProfessionsController::class, 'create'])->name('professions.create');
        Route::get('/professions/{professions}/edit', [ProfessionsController::class, 'edit'])->name('professions.edit');
        Route::delete('/professions/{professions}', [ProfessionsController::class, 'destroy'])->name('professions.destroy');
        Route::put('/professions/{professions}', [ProfessionsController::class, 'update'])->name('professions.update');
        Route::post('/professions', [ProfessionsController::class, 'store'])->name('professions.store');


    
        Route::get('news/1/edit', [NewsController::class, 'edit'])->name('news.edit');
        Route::post('news/1/update', [NewsController::class, 'update'])->name('news.update');

        
        Route::get('appsettings/{id}/edit', [AppsettingsController::class, 'edit'])->name('appsettings.edit');
        Route::put('appsettings/{id}/update', [AppsettingsController::class, 'update'])->name('appsettings.update');
        
    
        //Verifications  
        Route::get('/verifications', [VerificationsController::class, 'index'])->name('verifications.index');
        Route::delete('/verifications/{verifications}', [VerificationsController::class, 'destroy'])->name('verifications.destroy');
        Route::post('/verifications/verify', [VerificationsController::class, 'verify'])->name('verifications.verify');


            //Verifications  
            Route::get('/transactions', [TransactionsController::class, 'index'])->name('transactions.index');
            Route::delete('/transactions/{transactions}', [TransactionsController::class, 'destroy'])->name('transactions.destroy');
            
    

        //Bulk Users
       // web.php
// Define the route for the "Upload Bulk Users" page
Route::get('bulk-users/upload', [BulkUserController::class, 'create'])->name('bulk-users.upload');
Route::post('bulk-users/upload', [BulkUserController::class, 'store'])->name('bulk-users.store');

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
    Route::post('/cart/change-qty', [CartController::class, 'changeQty']);
    Route::delete('/cart/delete', [CartController::class, 'delete']);
    Route::delete('/cart/empty', [CartController::class, 'empty']);
});
// OneSignal service worker route
Route::get('/OneSignalSDKWorker.js', function () {
    return response()->file(public_path('OneSignalSDKWorker.js'));
});