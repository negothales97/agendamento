<?php

use App\Http\Controllers\Api\CardController;
use App\Http\Controllers\Api\CashController;
use App\Http\Controllers\Api\Customer\AgoraIoController;
use App\Http\Controllers\Api\Customer\FavoriteController;
use App\Http\Controllers\Api\Customer\LoginController;
use App\Http\Controllers\Api\Customer\RegisterController;
use App\Http\Controllers\Api\Customer\ScheduleController as CustomerScheduleController;
use App\Http\Controllers\Api\Customer\SettingsController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\PageController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\ScheduleController;
use App\Http\Controllers\Api\SmsController;
use App\Http\Controllers\Api\SpecialistController;
use App\Http\Controllers\Api\SpecialtyController;
use App\Http\Controllers\Api\VariableController;
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

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::put('/customer', [CustomerController::class, 'update']);
    Route::get('/customer', [CustomerController::class, 'getUser']);
    Route::get('/customer/refresh-token', [CustomerController::class, 'refreshToken']);
    Route::post('/customer/logout', [LoginController::class, 'logout']);

    Route::put('/settings', [SettingsController::class, 'update']);

    Route::get('/posts', [PostController::class, 'paginate']);
    Route::get('/posts/{id}', [PostController::class, 'show']);

    Route::get('/specialties', [SpecialtyController::class, 'getAll']);
    Route::get('/specialties/{id}', [SpecialtyController::class, 'show']);

    Route::get('/specialists', [SpecialistController::class, 'paginate']);
    Route::get('/specialists/{id}', [SpecialistController::class, 'show']);
    Route::get('/specialists/{id}/schedules', [ScheduleController::class, 'index']);
    Route::post('specialists/{id}/favorite', [FavoriteController::class, 'add']);

    Route::get('/favorite', [FavoriteController::class, 'list']);

    Route::get('/schedules', [CustomerScheduleController::class, 'index']);
    Route::post('/schedules/{id}/confirm', [CustomerScheduleController::class, 'confirm']);
    Route::get('/schedules/{id}/cancel', [CustomerScheduleController::class, 'valueRefund']);
    Route::delete('/schedules/{id}/cancel', [CustomerScheduleController::class, 'cancel']);
    Route::post('schedules/{id}/agoraio', [AgoraIoController::class, 'generateToken']);

    Route::get('/variables/{id}', [VariableController::class, 'show']);

    Route::get('/credit_cards', [CardController::class, 'list']);
    Route::post('/credit_cards', [CardController::class, 'store']);
    Route::delete('/credit_cards/{id}', [CardController::class, 'delete']);


    Route::get('/cash', [CashController::class, 'list']);
    Route::post('/cash', [CashController::class, 'add']);
});

Route::get('/pages', [PageController::class, 'index']);
Route::get('/pages/{id}', [PageController::class, 'show']);

Route::get('schedules/{specialist_id}/specialist', [ScheduleController::class, 'index']);
Route::get('schedules/{id}', [ScheduleController::class, 'show']);
Route::post('schedules', [ScheduleController::class, 'store']);
Route::put('schedules/{id}', [ScheduleController::class, 'update']);
Route::delete('schedules/{id}', [ScheduleController::class, 'delete']);


Route::post('/customer/login', [LoginController::class, 'login']);
Route::post('/customer/register', [RegisterController::class, 'register']);

Route::post('/send-sms', [SmsController::class, 'send']);

Route::get('/postback', function (Request $request) {
    return 'success';
});
