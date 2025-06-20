<?php

use Illuminate\Support\Facades\Route;

use App\Livewire\Pages\Dashboard;



Route::get('/', Dashboard::class)->name('dashboard');


Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
