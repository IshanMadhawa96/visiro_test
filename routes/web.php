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
    Route::get('admin/users/list',[AdminController::class,'list']);
    Route::get('admin/users/add',[AdminController::class,'add']);
    Route::post('admin/users/add',[AdminController::class,'insert']);
    Route::get('admin/users/edit/{id}',[AdminController::class,'edit']);
    Route::post('admin/users/edit/{id}',[AdminController::class,'update']);
    Route::get('admin/users/delete/{id}',[AdminController::class,'delete']);
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
