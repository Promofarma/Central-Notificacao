<?php

declare(strict_types=1);

use App\Http\Controllers\LogoutController;
use App\Livewire\Auth\Login;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->get('/', Login::class)->name('login');

Route::group(['middleware' => 'auth'], function (): void {
    Route::get('/logout', LogoutController::class)->name('logout');

    Route::get('/dashboard', fn (): string => 'Dashboard  <a href="' . route('logout') . '">sair</a>')->name('dashboard'); // @temporary
});
