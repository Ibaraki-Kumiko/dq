<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\PasswordController;
use App\Mail\TestEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('forgot', [PasswordController::class, 'forgot']);
Route::post('reset', [PasswordController::class, 'reset']);



Route::post('/feedback', [FeedbackController::class, 'submitForm'])->name('submit.form');


Route::middleware('auth:sanctum')->group(function () {
    Route::get('user', [AuthController::class, 'user']);
    Route::post('logout', [AuthController::class, 'logout']);

    //modules
    Route::get('/modules', [\App\Http\Controllers\ModuleController::class, 'index']);
    Route::get('/modules/{slug}', [\App\Http\Controllers\ModuleController::class, 'show']);

//UNIT
//Route::get('/modules/{id}/{unit_id}', [\App\Http\Controllers\UnitController::class, 'show']);
    Route::get('/modules/{module_slug}/{unit_slug}', [\App\Http\Controllers\UnitController::class, 'show']);

//Dictionary
    Route::get('/dictionary/{slug}', [\App\Http\Controllers\DictionaryController::class, 'show']);
    Route::post('/dictionary/',  [\App\Http\Controllers\DictionaryController::class, 'store']);


//Exercise
    Route::get('/exercise/{id}', [\App\Http\Controllers\ExerciseController::class, 'show']);
//Route::get('/exercises/{unit_id}', [\App\Http\Controllers\ExerciseController::class, 'index']);
    Route::get('/exercises/{slug}', [\App\Http\Controllers\ExerciseController::class, 'index']);
    Route::get('/exercises', \App\Http\Controllers\ExerciseIndexController::class);


//OPTIONS
    Route::get('/options/{id}', [\App\Http\Controllers\OptionController::class, 'show']);


//Answers
    Route::post('/check/{id}', [\App\Http\Controllers\AnswerController::class, 'check']);
    Route::get('/answers/{id}', [\App\Http\Controllers\AnswerController::class, 'show']);


});

//Admin panel

Route::group([ 'prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['role:admin', 'auth:sanctum']], function() {
    Route::get('/modules', '\App\Http\Controllers\Admin\ModuleController@index')->name('admin.module.index');
    Route::get('/dashboard', function() {
        return 'Willkommen, Administrator';
    });


});

//ChatGPT test
/*Route::get('/chat', [\App\Http\Controllers\ChatController::class, 'send']);*/
