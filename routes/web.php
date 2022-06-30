<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/administrativo', [App\Http\Controllers\HomeController::class, 'admin'])->name('admin');
    Route::get('/noticias', [App\Http\Controllers\NoticiaController::class, 'index'])->name('noticia.index');
    Route::get('/noticias/{id}', [App\Http\Controllers\NoticiaController::class, 'show'])->name('noticia.show');
});

Route::prefix('admin')->group(function () {

    Route::group(['prefix' => '/usuarios'], function () {
        Route::get('/', [App\Http\Controllers\UserController::class, 'index'])->name('user.index');
        Route::get('/{id}', [App\Http\Controllers\UserController::class, 'show'])->name('user.show');
        Route::get('/{id}/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('user.edit');
        Route::get('/{id}/edit/role', [App\Http\Controllers\UserController::class, 'editRole'])->name('user.edit.role');
        Route::put('/{id}/update', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');
        Route::put('/{id}/update/role', [App\Http\Controllers\UserController::class, 'updateRole'])->name('user.update.role');
        Route::post('/{id}/delete', [App\Http\Controllers\UserController::class, 'delete'])->name('user.delete');
    });

    Route::group(['prefix' => '/noticias'], function () {
        Route::get('/create', [App\Http\Controllers\NoticiaController::class, 'create'])->name('noticia.create');
        Route::post('/store', [App\Http\Controllers\NoticiaController::class, 'store'])->name('noticia.store');
        Route::get('/{id}/edit', [App\Http\Controllers\NoticiaController::class, 'edit'])->name('noticia.edit');
        Route::put('/{id}/update', [App\Http\Controllers\NoticiaController::class, 'update'])->name('noticia.update');
        Route::post('/{id}/delete', [App\Http\Controllers\NoticiaController::class, 'delete'])->name('noticia.delete');
    });

});