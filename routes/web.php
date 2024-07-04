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
    Route::get('login', [\App\Http\Controllers\SsoController::class, 'login'])->name('esi.sso.login');
    Route::get('callback', [\App\Http\Controllers\SsoController::class, 'callback'])->name('esi.sso.callback');
    Route::get('logout', [\App\Http\Controllers\SsoController::class, 'logout'])->name('esi.sso.logout');
});

Route::group(['prefix' => 'apply'], function() {
    Route::get('', [\App\Http\Controllers\Applications\ApplicationsController::class, 'index'])->name('apply');
    Route::post('submit', [\App\Http\Controllers\Applications\ApplicationsController::class, 'submit'])->name('apply.submit');
});

Route::middleware('esi')->group(function() {
    Route::get('mailbox', [\App\Http\Controllers\MailController::class, 'index'])->name('mail.mailbox');
    Route::get('mailbox/{id}', [\App\Http\Controllers\MailController::class, 'view'])->name('mail.mailbox.view');
});

Route::middleware('esi')->prefix('corporation')->group(function() {
    Route::get('dashboard', [\App\Http\Controllers\Corporation\DashboardController::class, 'index'])->name('corporation.dashboard');
    
    Route::get('applications', [\App\Http\Controllers\Corporation\ApplicationsController::class, 'index'])->name('corporation.applications');
    Route::get('applications/{applicant}', [\App\Http\Controllers\Corporation\ApplicationsController::class, 'view'])->name('corporation.applications.view');
    Route::put('applications/{applicant}', [\App\Http\Controllers\Corporation\ApplicationsController::class, 'decideApplication'])->name('corporation.applications.update');
    
    Route::get('contracts', [\App\Http\Controllers\Corporation\ContractsController::class, 'index'])->name('corporation.contracts');
    Route::post('contracts', [\App\Http\Controllers\Corporation\ContractsController::class, 'updateContractsFromEsi'])->name('corporation.contracts.update');
    
    Route::get('finances', [\App\Http\Controllers\Corporation\FinanceController::class, 'index'])->name('corporation.finances');
    Route::post('finances', [\App\Http\Controllers\Corporation\FinanceController::class, 'updateJournalTransactionsFromEsi'])->name('corporation.finances.update');
    
    Route::get('orders', [\App\Http\Controllers\Corporation\OrdersController::class, 'index'])->name('corporation.orders');
    Route::post('orders', [\App\Http\Controllers\Corporation\OrdersController::class, 'updateOrderHistoryFromEsi'])->name('corporation.orders.update');
});
