<?php

use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function (): void {
    Route::livewire('/login', 'auth.login')->name('login');
});

Route::post('/logout', function () {
    auth()->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect()->route('login');
})->middleware('auth')->name('logout');

Route::middleware(['auth', 'role:super-admin'])->group(function (): void {
    Route::livewire('/', 'admin.dashboard')->name('dashboard');
    Route::livewire('/demo/counter', 'counter');
});
