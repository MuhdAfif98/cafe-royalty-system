<?php

use App\Livewire\Dashboard;
use App\Livewire\Purchases;
use App\Livewire\Rewards;
use App\Livewire\Profile;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/purchases', Purchases::class)->name('purchases');
    Route::get('/rewards', Rewards::class)->name('rewards');
    Route::get('/profile', Profile::class)->name('profile');

    // Staff routes
    Route::get('/staff', \App\Livewire\Staff\Dashboard::class)->name('staff.dashboard');
});

// Staff login (no auth required)
Route::get('/staff/login', \App\Livewire\Staff\Login::class)->name('staff.login');

require __DIR__.'/auth.php';
