<?php

declare(strict_types=1);

use App\Http\Controllers\LogoutController;
use App\Livewire\Auth\Login;
use App\Livewire\Dashboard\Dashboard;
use App\Livewire\Notification\Create;
use App\Livewire\Notification\Index;
use App\Livewire\Recipient\Index as RecipientIndex;
use App\Livewire\Notification\Show;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->get('/', Login::class)->name('login');

Route::group(['prefix' => 'recipient'], function (): void {
    Route::get('/{recipient}', RecipientIndex::class)->name('recipient.index');
});

Route::group(['middleware' => 'auth'], function (): void {
    Route::get('/logout', LogoutController::class)->name('logout');

    Route::get('/dashboard', Dashboard::class)->name('dashboard');

    Route::group(['prefix' => 'notifications'], function (): void {
        Route::get('/', Index::class)->name('notification.index');
        Route::get('/create', Create::class)->name('notification.create');
        Route::get('/{notification}', Show::class)->name('notification.show');
    });
});
