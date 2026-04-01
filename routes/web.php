<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('auth.login');
})->middleware('guest');

Auth::routes(['register' => false]);

Route::group(['middleware' => 'auth'], function () {
    
    // Dashboard & Home
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Chart Data Routes (Names synchronized with Blade file)
    Route::get('/sales-purchases/chart-data', [HomeController::class, 'salesPurchasesChart'])
        ->name('sales-purchases.chart');

    Route::get('/current-month/chart-data', [HomeController::class, 'currentMonthChart'])
        ->name('current-month-chart-data');
  
    Route::get('/payment-flow/chart-data', [HomeController::class, 'paymentChart'])
        ->name('payment-chart-data');

    // Modules
    Route::resource('projects', ProjectController::class);
    Route::resource('departments', DepartmentController::class);
        
});