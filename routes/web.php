<?php

use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TaskController;
use App\Http\Controllers\Admin\UserController;
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

Route::get('/', function () {
    return view('auth.login');
});

Route::prefix('admin')->group(function () {
  Route::group(['middleware' => 'auth'], function() {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard.index');
  
    // User 
    Route::get('/user', [UserController::class, 'index'])->name('admin.user.index');
    Route::get('/user/create', [UserController::class, 'create'])->name('admin.user.create');
    Route::post('/user/store', [UserController::class, 'store'])->name('admin.user.store');
    Route::get('/user/edit/{user}', [UserController::class, 'edit'])->name('admin.user.edit');
    Route::put('/user/update/{user}', [UserController::class, 'update'])->name('admin.user.update');
    Route::delete('/user/{id}', [UserController::class, 'destroy']);
  
    // Customer
    Route::get('/customer', [CustomerController::class, 'index'])->name('admin.customer.index');
    Route::get('/customer/create', [CustomerController::class, 'create'])->name('admin.customer.create');
    Route::post('/customer/store', [CustomerController::class, 'store'])->name('admin.customer.store');
    Route::get('/customer/edit/{customer}', [CustomerController::class, 'edit'])->name('admin.customer.edit');
    Route::put('/customer/update/{customer}', [CustomerController::class, 'update'])->name('admin.customer.update');
    Route::delete('/customer/{id}', [CustomerController::class, 'destroy']);
  
    // Task
    Route::get('/task', [TaskController::class, 'index'])->name('admin.task.index');
    Route::get('/task/create', [TaskController::class, 'create'])->name('admin.task.create');
    Route::post('/task/store', [TaskController::class, 'store'])->name('admin.task.store');
    Route::get('/task/search-customer', [TaskController::class, 'searchCustomer'])->name('admin.task.search-customer');
    Route::get('/task/search-customer/{id}', [TaskController::class, 'searchCustomerID']);
    Route::get('/task/search-pic', [TaskController::class, 'searchPersonInCharge'])->name('admin.task.search-pic');
    Route::get('/task/search-pic/{id}', [TaskController::class, 'searchPICID']);
  
    Route::get('/task/session', [TaskController::class, 'accessSessionData']);

  });

});

