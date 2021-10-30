<?php

use App\Http\Controllers\Specialist\BalanceController;
use App\Http\Controllers\Specialist\CalendarController;
use App\Http\Controllers\Specialist\CallController;
use App\Http\Controllers\Specialist\DashboardController;
use App\Http\Controllers\Specialist\PlaceController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');


// Locais de atendimento
Route::group(['prefix' => 'places', 'as' => 'place.'], function () {
    Route::get('/', [PlaceController::class, 'index'])->name('index');
    Route::post('/', [PlaceController::class, 'store'])->name('store');
    Route::get('/status/{id}', [PlaceController::class, 'status'])->name('status');
    Route::get('/use-online/{id}', [PlaceController::class, 'useOnline'])->name('use-online');
    Route::put('/{id}', [PlaceController::class, 'update'])->name('update');
    Route::delete('/{id}', [PlaceController::class, 'delete'])->name('delete');
});

Route::group(['prefix' => 'calendars', 'as' => 'calendar.'], function () {
    Route::get('/', [CalendarController::class, 'index'])->name('index');
    Route::get('/create', [CalendarController::class, 'create'])->name('create');
    Route::post('/', [CalendarController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [CalendarController::class, 'edit'])->name('edit');
    Route::get('/status/{id}', [CalendarController::class, 'status'])->name('status');
    Route::get('/use-online/{id}', [CalendarController::class, 'useOnline'])->name('use-online');
    Route::put('/{id}', [CalendarController::class, 'update'])->name('update');
    Route::delete('/{id}', [CalendarController::class, 'delete'])->name('delete');
});

Route::group(['prefix' => 'calls', 'as' => 'call.'], function () {
    Route::get('/', [CallController::class, 'index'])->name('index');
    Route::get('/{id}', [CallController::class, 'show'])->name('show');
});

Route::group(['prefix' => 'balances', 'as' => 'balance.'], function () {
    Route::get('/', [BalanceController::class, 'index'])->name('index');
    Route::post('/', [BalanceController::class, 'transfer'])->name('transfer');
});
