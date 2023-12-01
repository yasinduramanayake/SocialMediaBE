<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\SubCategoryManagement\Http\Controllers\SubCategoryManagementController;

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

// Route::middleware('auth:api')->get('/subcategorymanagement', function (
//     Request $request
// ) {
//     return $request->user();
// });
Route::group(['middleware' => ['auth:api', 'role:Admin', 'permission:Add SubCategories|Add Categories|Add Services']], function () {
    Route::post('addsubcategory', [
        SubCategoryManagementController::class,
        'store',
    ]);
    Route::put('updatesubcategory/{id}', [SubCategoryManagementController::class, 'update']);
    Route::delete('deletesubcategory/{id}', [SubCategoryManagementController::class, 'destroy']);
});

Route::post('showsubcategories', [
    SubCategoryManagementController::class,
    'index',
]);
