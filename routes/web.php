<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::prefix('/admin')->group(function () {

    Route::group(['prefix' => '/usuarios'], function () {
        Route::get('/', [App\Http\Controllers\UserController::class, 'index'])->name('user.index');
        Route::get('/create', [App\Http\Controllers\UserController::class, 'create'])->name('user.create');
        Route::post('/store', [App\Http\Controllers\UserController::class, 'store'])->name('user.create');
        Route::get('/{id}', [App\Http\Controllers\UserController::class, 'show'])->name('user.show');
        Route::get('/{id}/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('user.edit');
        Route::put('/{id}/update', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');
        Route::post('/delete', [App\Http\Controllers\UserController::class, 'delete'])->name('user.delete');
    });

});