<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\DashboardController;

Route::get('/',[AuthController::class,'login']);
Route::get('logout',[AuthController::class,'logout']);
Route::post('login',[AuthController::class,'AuthLogin']);
Route::get('forgot-password',[AuthController::class,'forgotPassword']);
Route::post('forgot-password',[AuthController::class,'postForgotPassword']);
Route::get('reset/{token}',[AuthController::class,'reset']);
Route::post('reset/{token}',[AuthController::class,'postReset']);

Route::group(['middleware'=>'admin'],function(){
    Route::get('admin/dashboard',[DashboardController::class,'dashboard']);
});

Route::group(['middleware'=>'crm'],function(){
    Route::get('crm/dashboard',[DashboardController::class,'dashboard']);
});

Route::group(['middleware'=>'payroll'],function(){
    Route::get('payroll/dashboard',[DashboardController::class,'dashboard']);
});

Route::group(['middleware'=>'hr'],function(){
    Route::get('hr/dashboard',[DashboardController::class,'dashboard']);
});
