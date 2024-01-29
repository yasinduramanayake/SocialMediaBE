<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\ReviewManagement\Http\Controllers\ReviewManagementController;

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

Route::post('addreview', [ReviewManagementController::class, 'store']);
Route::get('reviews', [ReviewManagementController::class, 'index']);
Route::delete('deletereview/{id}', [ReviewManagementController::class, 'destroy']);


Route::post('addcontactus', [ReviewManagementController::class, 'addcontact']);
