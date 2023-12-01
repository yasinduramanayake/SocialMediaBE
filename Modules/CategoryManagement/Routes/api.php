<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\CategoryManagement\Http\Controllers\CategoryManagementController;

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

// Route::middleware('auth:api')->get('/categorymanagement', function (Request $request) {
//     return $request->user();
// });

Route::group(['middleware' => ['auth:api', 'role:Admin', 'permission:Add Categories']], function () {
    Route::post('addcategory', [CategoryManagementController::class, 'store']);
    Route::put('updatececategory/{id}', [CategoryManagementController::class, 'update']);
    Route::delete('deletecategory/{id}', [CategoryManagementController::class, 'destroy']);
});


Route::get('allcategories', [CategoryManagementController::class, 'index']);
Route::get('allmainservicecategories', [CategoryManagementController::class, 'showMainCategoryServices']);
