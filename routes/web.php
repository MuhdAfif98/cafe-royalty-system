<?php

use App\Livewire\Dashboard;
use App\Livewire\Rewards;
use App\Livewire\Profile;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware(['auth', 'mobile.only'])->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/rewards', Rewards::class)->name('rewards');
    Route::get('/profile', Profile::class)->name('profile');

    // Staff routes
    Route::get('/staff', \App\Livewire\Staff\Dashboard::class)->name('staff.dashboard');

    // Install Guide
    Route::get('/install', \App\Livewire\InstallGuide::class)->name('install');
});

// Staff login (no auth required, but mobile only)
Route::get('/staff/login', \App\Livewire\Staff\Login::class)->name('staff.login')->middleware('mobile.only');

require __DIR__.'/auth.php';
