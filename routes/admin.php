<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BalanceController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\SpecialistController;
use App\Http\Controllers\Admin\PlaceController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\SpecialtyCategoryController;
use App\Http\Controllers\Admin\SpecialtyController;
use App\Http\Controllers\Admin\VariableController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');

Route::group(['prefix' => 'balances', 'as' => 'balance.'], function () {
    Route::get('/', [BalanceController::class, 'index'])->name('index');
    Route::post('/', [BalanceController::class, 'transfer'])->name('transfer');
});
// Colaboradores
Route::group(['prefix' => 'admins', 'as' => 'admin.'], function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::get('/create', [AdminController::class, 'create'])->name('create');
    Route::post('/', [AdminController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [AdminController::class, 'edit'])->name('edit');
    Route::put('/{id}', [AdminController::class, 'update'])->name('update');
    Route::delete('/{id}', [AdminController::class, 'delete'])->name('delete');
});
// Usuários
Route::group(['prefix' => 'customers', 'as' => 'customer.'], function () {
    Route::get('/', [CustomerController::class, 'index'])->name('index');
    Route::get('/edit/{id}', [CustomerController::class, 'edit'])->name('edit');
    Route::put('/{id}', [CustomerController::class, 'update'])->name('update');
    Route::delete('/{id}', [CustomerController::class, 'delete'])->name('delete');
});
// Especialidades
Route::group(['prefix' => 'specialties', 'as' => 'specialty.'], function () {
    Route::get('/', [SpecialtyController::class, 'index'])->name('index');
    Route::get('/create', [SpecialtyController::class, 'create'])->name('create');
    Route::post('/', [SpecialtyController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [SpecialtyController::class, 'edit'])->name('edit');
    Route::put('/{id}', [SpecialtyController::class, 'update'])->name('update');
    Route::delete('/{id}', [SpecialtyController::class, 'delete'])->name('delete');
    // Categorias
    Route::group(['prefix' => 'categories', 'as' => 'category.'], function () {
        Route::get('/', [SpecialtyCategoryController::class, 'index'])->name('index');
        Route::post('/', [SpecialtyCategoryController::class, 'store'])->name('store');
        Route::put('/{id}', [SpecialtyCategoryController::class, 'update'])->name('update');
        Route::delete('/{id}', [SpecialtyCategoryController::class, 'delete'])->name('delete');
    });
});
// Especialistas
Route::group(['prefix' => 'specialists', 'as' => 'specialist.'], function () {
    Route::get('/', [SpecialistController::class, 'index'])->name('index');
    Route::get('/create', [SpecialistController::class, 'create'])->name('create');
    Route::post('/', [SpecialistController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [SpecialistController::class, 'edit'])->name('edit');
    Route::put('/{id}', [SpecialistController::class, 'update'])->name('update');
    Route::delete('/{id}', [SpecialistController::class, 'delete'])->name('delete');
});
// Locais de atendimento
Route::group(['prefix' => 'places', 'as' => 'place.'], function () {
    Route::post('/', [PlaceController::class, 'store'])->name('store');
    Route::get('/status/{id}', [PlaceController::class, 'status'])->name('status');
    Route::get('/use-online/{id}', [PlaceController::class, 'useOnline'])->name('use-online');
    Route::put('/{id}', [PlaceController::class, 'update'])->name('update');
    Route::delete('/{id}', [PlaceController::class, 'delete'])->name('delete');
});
// Posts
Route::group(['prefix' => 'posts', 'as' => 'post.'], function () {
    Route::get('/', [PostController::class, 'index'])->name('index');
    Route::get('/create', [PostController::class, 'create'])->name('create');
    Route::post('/', [PostController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [PostController::class, 'edit'])->name('edit');
    Route::put('/{id}', [PostController::class, 'update'])->name('update');
    Route::delete('/{id}', [PostController::class, 'delete'])->name('delete');
});
// Variáveis
Route::group(['prefix' => 'variables', 'as' => 'variable.'], function () {
    Route::get('/edit/{id}', [VariableController::class, 'edit'])->name('edit');
    Route::put('/{id}', [VariableController::class, 'update'])->name('update');
});
// Páginas
Route::group(['prefix' => 'pages', 'as' => 'page.'], function () {
    Route::get('/edit/{id}', [PageController::class, 'edit'])->name('edit');
    Route::put('/{id}', [PageController::class, 'update'])->name('update');
});
