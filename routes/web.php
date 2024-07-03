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
Route::get('/services/haulage', [\Mesa\Http\Controllers\StaticPageController::class, 'haulage'])->name('haulage');

Route::group(['prefix' => 'eveauth'], function() {
    Route::get('login', [\Mesa\Http\Controllers\SsoController::class, 'login'])->name('esi.sso.login');
    Route::get('corporate/login', [\Mesa\Http\Controllers\SsoController::class, 'corporateLogin'])->name('esi.corporate.login');
    Route::get('callback', [\Mesa\Http\Controllers\SsoController::class, 'callback'])->name('esi.sso.callback');
    Route::get('logout', [\Mesa\Http\Controllers\SsoController::class, 'logout'])->name('esi.sso.logout');
});

Route::group(['prefix' => 'apply'], function() {
    Route::get('', [\Mesa\Http\Controllers\CorporateApplicants\ApplicationsController::class, 'index'])->name('apply');
    Route::post('submit', [\Mesa\Http\Controllers\CorporateApplicants\ApplicationsController::class, 'submit'])->name('apply.submit');
});

Route::middleware('esi')->prefix('corporate')->group(function() {
    Route::get('management', [\Mesa\Http\Controllers\CorporateManagement\HomeController::class, 'index'])->name('corporate.management');
    Route::get('mailbox', [\Mesa\Http\Controllers\CorporateManagement\MailController::class, 'index'])->name('corporate.mailbox');
    Route::get('mailbox/{id}', [\Mesa\Http\Controllers\CorporateManagement\MailController::class, 'view'])->name('corporate.mailbox.view');
    Route::get('applications', [\Mesa\Http\Controllers\CorporateManagement\ApplicationsController::class, 'index'])->name('corporate.applications');
    Route::get('applications/{applicant}', [\Mesa\Http\Controllers\CorporateManagement\ApplicationsController::class, 'view'])->name('corporate.applications.view');
    Route::put('applications/{applicant}', [\Mesa\Http\Controllers\CorporateManagement\ApplicationsController::class, 'decideApplication'])->name('corporate.applications.update');
    Route::get('contracts', [\Mesa\Http\Controllers\CorporateManagement\ContractsController::class, 'index'])->name('corporate.contracts');
    Route::post('contracts', [\Mesa\Http\Controllers\CorporateManagement\ContractsController::class, 'updateContractsFromEsi'])->name('corporate.contracts.update');
    Route::get('finances', [\Mesa\Http\Controllers\CorporateManagement\FinanceController::class, 'index'])->name('corporate.finances');
    Route::post('finances', [\Mesa\Http\Controllers\CorporateManagement\FinanceController::class, 'updateJournalTransactionsFromEsi'])->name('corporate.finances.update');
    Route::get('orders', [\Mesa\Http\Controllers\CorporateManagement\OrdersController::class, 'index'])->name('corporate.orders');
    Route::post('orders', [\Mesa\Http\Controllers\CorporateManagement\OrdersController::class, 'updateOrderHistoryFromEsi'])->name('corporate.orders.update');
});

Route::post('/import/{type}/{subtype}', [\Mesa\Http\Controllers\CorporateManagement\ImportController::class, 'import'])->name('import');
