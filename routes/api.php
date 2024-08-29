<?php

use App\Http\Controllers\API\CategorysController;
use App\Http\Controllers\Api\DepartmentsController;
use App\Http\Controllers\Api\TicketskController;
use Illuminate\Http\Request;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

## ticket data view using api
//  Route::middleware('auth:sanctum')->group( function () {
    Route::resource('tickets', TicketskController::class);
    Route::resource('category', CategorysController::class);
    Route::resource('departments', DepartmentsController::class);
// });

