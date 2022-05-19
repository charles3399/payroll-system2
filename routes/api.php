<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\PayrollController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->group(function() {
    Route::apiResources([
        'employees' => EmployeeController::class,
        'positions' => PositionController::class,
        'payrolls' => PayrollController::class,
    ]);
    Route::get('allPosition', [PositionController::class, 'showPositions']);
    Route::get('allEmployee', [EmployeeController::class, 'showEmployees']);
    Route::get('allPayroll', [PayrollController::class, 'showPayrolls']);
});