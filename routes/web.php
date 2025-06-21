<?php

use App\Livewire\Pages\Calendar;
use App\Livewire\Pages\Dashboard;
use App\Livewire\Pages\Settings;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('/settings', Settings::class)->name('settings');
});

Route::get('/calendar', Calendar::class)->name('calendar');

Route::get('/', Dashboard::class)->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
use Illuminate\Support\Facades\Auth;

Route::post('/logout', function () {
    Auth::logout();

    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect('/login');
})->name('logout')->middleware('auth');
