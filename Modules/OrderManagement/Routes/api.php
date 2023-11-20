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

Route::middleware('auth:api')->get('/ordermanagement', function (Request $request) {
    return $request->user();
});

Route::post('addorder', [OrderManagementController::class, 'store']);
Route::get('allorderss', [OrderManagementController::class, 'index']);
