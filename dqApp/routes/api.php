<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\PasswordController;
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

  /*  Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
    });*/



Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('forgot', [PasswordController::class, 'forgot']);
Route::post('reset', [PasswordController::class, 'reset']);


Route::post('/feedback', [FeedbackController::class, 'submitForm'])->name('submit.form');

/*Route::get('/user', function (Request $request) {
    dd($request->user());
    return $request->user();
});*/
Route::middleware('auth:sanctum')->group(function () {
    Route::get('user', [AuthController::class, 'user']);
    Route::post('logout', [AuthController::class, 'logout']);


});
//modules
Route::get('/modules', [\App\Http\Controllers\ModuleController::class, 'index']);
Route::get('/modules/{id}', [\App\Http\Controllers\ModuleController::class, 'show']);

//UNIT
Route::get('/modules/{id}/{unit_id}', [\App\Http\Controllers\UnitController::class, 'show']);
