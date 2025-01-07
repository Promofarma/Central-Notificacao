<?php

declare(strict_types=1);

use App\Http\Controllers\LogoutController;
use App\Livewire\Auth\Login;
use App\Livewire\Dashboard\Dashboard;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->get('/', Login::class)->name('login');

Route::group(['middleware' => 'auth'], function (): void {
    Route::get('/logout', LogoutController::class)->name('logout');

    Route::get('/dashboard', Dashboard::class)->name('dashboard');
});
