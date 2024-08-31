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

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'auth'], function() {
    Route::get('login', [\App\Http\Controllers\SSOController::class, 'login'])->name('esi.sso.login');
    Route::get('callback', [\App\Http\Controllers\SSOController::class, 'callback'])->name('esi.sso.callback');
    Route::get('logout', [\App\Http\Controllers\SSOController::class, 'logout'])->name('esi.sso.logout');
});

Route::middleware('esi')->group(function() {
    Route::prefix('evemail')->group(function() {
        Route::get('mailbox', [\App\Http\Controllers\EVEMailController::class, 'index'])->name('mail.mailbox');
        Route::get('mailbox/{id}', [\App\Http\Controllers\EVEMailController::class, 'view'])->name('mail.mailbox.view');
    });

    Route::prefix('corporation')->group(function() {
        Route::get('dashboard', [\App\Http\Controllers\Corporation\DashboardController::class, 'index'])->name('corporation.dashboard');
    
        Route::get('contracts', [\App\Http\Controllers\Corporation\ContractsController::class, 'index'])->name('corporation.contracts');
        Route::post('contracts', [\App\Http\Controllers\Corporation\ContractsController::class, 'updateContractsFromESI'])->name('corporation.contracts.update');
        
        Route::get('finances', [\App\Http\Controllers\Corporation\FinanceController::class, 'index'])->name('corporation.finances');
        Route::post('finances', [\App\Http\Controllers\Corporation\FinanceController::class, 'updateJournalTransactionsFromESI'])->name('corporation.finances.update');
        
        Route::get('orders', [\App\Http\Controllers\Corporation\OrdersController::class, 'index'])->name('corporation.orders');
        Route::post('orders', [\App\Http\Controllers\Corporation\OrdersController::class, 'updateOrderHistoryFromESI'])->name('corporation.orders.update');
    });
});
