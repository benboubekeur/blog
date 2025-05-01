<?php

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/cache/testing', function () {

    if (Cache::store('redis')->put('redis-test', 'Redis is working!', 100)) {
        return Cache::store('redis')->get('redis-test');
    }

    return 'Redis connection failed';
});

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
