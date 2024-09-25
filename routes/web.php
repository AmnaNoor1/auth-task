<?php

use App\Http\Controllers\admin\CardController;
use App\Http\Controllers\admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\admin\LoginController as AdminLoginController;
use App\Http\Controllers\admin\CategoryController;

use App\Http\Controllers\user\LoginController;
use App\Http\Controllers\user\DashboardController;
use Illuminate\Support\Facades\Route;


//user
Route::group(['prefix'=>'account'],function(){
    Route::group(['middleware'=>'guest'],function(){
        Route::get('login',[LoginController::class, 'index'])->name('account.login');
        Route::get('register',[LoginController::class, 'register'])->name('account.register');
        Route::post('process-register',[LoginController::class, 'processRegister'])->name('account.processRegister');
        Route::post('authenticate',[LoginController::class, 'authenticate'])->name('account.authenticate');

    });

    Route::group(['middleware'=>'auth'],function(){
        Route::get('logout',[LoginController::class, 'logout'])->name('account.logout');
        Route::get('dashboard',[DashboardController::class, 'index'])->name('account.dashboard');   
    });
   
});

//admin
Route::group(['prefix'=>'admin'],function(){
    Route::group(['middleware'=>'admin.guest'],function(){
        Route::get('login',[AdminLoginController::class, 'index'])->name('admin.login');
        Route::post('authenticate',[AdminLoginController::class, 'authenticate'])->name('admin.authenticate');
    });

    Route::group(['middleware'=>'admin.auth'],function(){
        // Route::get('dashboard',[AdminDashboardController::class, 'index'])->name('admin.dashboard'); 
        Route::get('logout',[AdminLoginController::class, 'logout'])->name('admin.logout');
        Route::get('addcard',[CardController::class, 'addcard'])->name('admin.addcard');
        Route::post('process-addcard',[CardController::class, 'store'])->name('admin.processAddcard');
        Route::get('addcategory',[CategoryController::class, 'index'])->name('admin.addcategory');
        Route::post('process-addcategory',[CategoryController::class, 'addcategory'])->name('admin.processAddcategory');
        Route::put('updatecategory',[CategoryController::class, 'updatecategory'])->name('admin.updatecategory');
        Route::delete('deletecategory/{id}',[CategoryController::class, 'deletecategory'])->name('admin.deletecategory');
        Route::get('dashboard',[CardController::class, 'viewallcards'])->name('admin.dashboard');
        // Route::get('editcard',[CardController::class, 'editcard'])->name('admin.editcard');
        Route::put('updatecard', [CardController::class, 'updatecard'])->name('admin.updatecard');
        Route::delete('deletecard/{id}', [CardController::class, 'deletecard'])->name('admin.deletecard');
    });
   
});


