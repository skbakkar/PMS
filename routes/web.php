<?php

use App\Presentation\Livewire\Medicine\CategoryManager;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')
        ->name('dashboard');

    Route::get('categories', CategoryManager::class)->name('categories.index');
});

require __DIR__.'/settings.php';
