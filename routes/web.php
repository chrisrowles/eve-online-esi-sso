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

Route::group(['prefix' => 'auth'], function() {
    Route::get('login', [\Mesa\Http\Controllers\SsoController::class, 'login'])->name('esi.sso.login');
    Route::get('callback', [\Mesa\Http\Controllers\SsoController::class, 'callback'])->name('esi.sso.callback');
    Route::get('logout', [\Mesa\Http\Controllers\SsoController::class, 'logout'])->name('esi.sso.logout');
});

Route::group(['prefix' => 'apply'], function() {
    Route::get('', [\Mesa\Http\Controllers\Applications\ApplicationsController::class, 'index'])->name('apply');
    Route::post('submit', [\Mesa\Http\Controllers\Applications\ApplicationsController::class, 'submit'])->name('apply.submit');
});

Route::middleware('esi')->prefix('corporation')->group(function() {
    Route::get('dashboard', [\Mesa\Http\Controllers\Corporation\HomeController::class, 'index'])->name('corporation.management');

    Route::get('mailbox', [\Mesa\Http\Controllers\Corporation\MailController::class, 'index'])->name('corporation.mailbox');
    Route::get('mailbox/{id}', [\Mesa\Http\Controllers\Corporation\MailController::class, 'view'])->name('corporation.mailbox.view');
    
    Route::get('applications', [\Mesa\Http\Controllers\Corporation\ApplicationsController::class, 'index'])->name('corporation.applications');
    Route::get('applications/{applicant}', [\Mesa\Http\Controllers\Corporation\ApplicationsController::class, 'view'])->name('corporation.applications.view');
    Route::put('applications/{applicant}', [\Mesa\Http\Controllers\Corporation\ApplicationsController::class, 'decideApplication'])->name('corporation.applications.update');
    
    Route::get('contracts', [\Mesa\Http\Controllers\Corporation\ContractsController::class, 'index'])->name('corporation.contracts');
    Route::post('contracts', [\Mesa\Http\Controllers\Corporation\ContractsController::class, 'updateContractsFromEsi'])->name('corporation.contracts.update');
    
    Route::get('finances', [\Mesa\Http\Controllers\Corporation\FinanceController::class, 'index'])->name('corporation.finances');
    Route::post('finances', [\Mesa\Http\Controllers\Corporation\FinanceController::class, 'updateJournalTransactionsFromEsi'])->name('corporation.finances.update');
    
    Route::get('orders', [\Mesa\Http\Controllers\Corporation\OrdersController::class, 'index'])->name('corporation.orders');
    Route::post('orders', [\Mesa\Http\Controllers\Corporation\OrdersController::class, 'updateOrderHistoryFromEsi'])->name('corporation.orders.update');
});
