<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => [
    'auth:sanctum',
    'verified'
]], function() {
    Route::get('/dashboard', function() {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/pages', function() {
        return view('admin.pages');
    })->name('pages');
});

Route::get('/{urlslug}', \App\Http\Livewire\Frontpage::class);
Route::get('/', \App\Http\Livewire\Frontpage::class);
