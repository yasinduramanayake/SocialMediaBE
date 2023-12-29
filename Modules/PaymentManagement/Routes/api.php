<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\PaymentManagement\Http\Controllers\PaymentManagementController;

/*
    |--------------------------------------------------------------------------
    | API Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register API routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | is assigned the "api" middleware group. Enjoy building your API!
    |
*/

Route::middleware(['auth:sanctum'])->prefix('v1')->name('api.')->group(function () {
    Route::get('paymentmanagement', fn (Request $request) => $request->user())->name('paymentmanagement');
});


Route::group(
    ['middleware' => ['auth:api', 'role:User', 'permission:Add Payments']],
    function () {
        Route::post('checkout', [PaymentManagementController::class, 'processTrasaction']);
        Route::get('successtransaction', [PaymentManagementController::class, 'successTransaction']); 
    }
);