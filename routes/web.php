<?php

use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Specialist\LoginController as SpecialistLoginController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect(url('/admin/login'));
});
Route::get('/home', function(){
    return view('home');
});
Auth::routes();

Route::name('admin.')->namespace('Admin')->prefix('admin')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/logout',  [LoginController::class, 'logout'])->name('logout');

    // Route::post('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
    // Route::post('/password/reset', 'Auth\ResetPasswordController@reset')->name('password.email');
    // Route::get('/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
    // Route::get('/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
});
Route::name('specialist.')->namespace('Specialist')->prefix('specialist')->group(function () {
    Route::get('/login', [SpecialistLoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [SpecialistLoginController::class, 'login']);
    Route::get('/logout',  [SpecialistLoginController::class, 'logout'])->name('logout');

    // Route::post('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
    // Route::post('/password/reset', 'Auth\ResetPasswordController@reset')->name('password.email');
    // Route::get('/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
    // Route::get('/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
});
