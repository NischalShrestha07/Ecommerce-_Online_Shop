<?php

use App\Http\Controllers\Admin\AdminLoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::group(['prefix' => 'admin'], function () {
    Route::group(['middleware' => 'admin.guest'], function () {
        //
        Route::get('/login', [AdminLoginController::class, 'index'])->name('admin.login');
    });



    Route::group(['middleware' => 'admin.auth'], function () {
        //
    });
});
