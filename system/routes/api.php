<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ReplyController;
use App\Http\Controllers\Api\ReportingController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\UserRoleController;
use App\Http\Controllers\Api\ReportTypeController;
use App\Http\Controllers\Api\LoginController;

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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::middleware('api')->group(function (){
    Route::get('gettype/{id}',[ReportTypeController::class,'getReportTypeByRole']);
    Route::post('login',[LoginController::class,'login']);
    Route::post('report/reslove',[ReportingController::class,'changeReportStates']);

    Route::resource('report',ReportingController::class);
    Route::resource('reply',ReplyController::class);
    Route::resource('user',UserController::class);
    Route::resource('userrole',UserRoleController::class);
//    Route::resource('reporttype',ReportTypeController::class);
});
