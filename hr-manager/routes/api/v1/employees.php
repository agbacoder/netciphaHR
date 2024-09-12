<?php

use App\Http\Controllers\Authcontroller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RolesController;

Route::
middleware([
    // 'auth:api',
    // 'middleware' => 'auth:sanctum',
    // 'prefix' => 'v1/employees'
])->
prefix('v1')
->group (function () {

    Route::post('/employees', [EmployeesController::class, 'store']);

    Route::get('/employees', [EmployeesController::class, 'index']);

    Route::get('/employees/{employees}', [EmployeesController::class, 'show']);

    Route::patch('/employees/{employees}', [EmployeesController::class, 'update']);

    Route::delete('/employees/{employees}', [EmployeesController::class, 'destroy']);

    Route::apiResource('/permissions' , PermissionController::class);

    Route::apiResource('/roles' , RolesController::class);
    Route::post('/roles/{roleId}/add-permission', [RolesController::class, 'addPermissionToRole']);


});

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();

// });







// Route::group([

//     'middleware' => 'api',
//     'prefix' => 'auth'

// ], function ($router) {

//     Route::post('/login', [AuthController::class, 'login']);

//     Route::post('/logout', [AuthController::class, 'logout']);

//     Route::post('refresh', 'AuthController@refresh');

//     Route::post('/personal', [AuthController::class, 'personal']);

// });
