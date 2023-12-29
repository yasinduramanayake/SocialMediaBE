<?php

use Illuminate\Http\Request;
use Modules\OrderManagement\Http\Controllers\OrderManagementController;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/ordermanagement', function (
    Request $request
) {
    return $request->user();
});

Route::group(
    ['middleware' => ['auth:api', 'role:Admin', 'permission:View Orders']],
    function () {
        Route::get('allorderss', [OrderManagementController::class, 'index']);
        Route::post('changeorderststus', [
            OrderManagementController::class,
            'changeStatus',
        ]);
    }
);
Route::post('addorder', [OrderManagementController::class, 'store']);

Route::post('cartorders', [
    OrderManagementController::class,
    'cartOrders',
]);
Route::delete('deleteorder/{id}', [
    OrderManagementController::class,
    'deleteorder',
]);

Route::post('trackorder', [OrderManagementController::class, 'orderTracking']);
