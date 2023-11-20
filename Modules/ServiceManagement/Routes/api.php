<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\ServiceManagement\Http\Controllers\ServiceManagementController;
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

Route::middleware('auth:api')->get('/servicemanagement', function (Request $request) {
    return $request->user();
});


Route::post('addservice', [ServiceManagementController::class, 'store']);
Route::post('showservices', [ServiceManagementController::class, 'index']);
Route::post('getscrapedata', [ServiceManagementController::class, 'scraper']);
