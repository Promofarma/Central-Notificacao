<?php

declare(strict_types=1);

use App\Helpers\AssetFileResponse;
use App\Http\Controllers\LogoutController;
use App\Livewire\Auth\Login;
// use App\Livewire\Dashboard\Dashboard; // TODO: implement dashboard
use App\Livewire\Notification\Create;
use App\Livewire\Notification\Index;
use App\Livewire\Notification\Show;
use App\Livewire\Recipient\Index as RecipientIndex;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

Route::middleware('guest')->get('/', Login::class)->name('login');

Route::group(['prefix' => 'recipient'], function (): void {
    Route::get('/{recipientId}/{notificationUuid?}', RecipientIndex::class)->name('recipient.index');
});

Route::group(['middleware' => 'auth'], function (): void {
    Route::get('/logout', LogoutController::class)->name('logout');

    Route::redirect('/dashboard', '/notifications');
    // Route::get('/dashboard', Dashboard::class)->name('dashboard'); // TODO: implement dashboard

    Route::group(['prefix' => 'notifications'], function (): void {
        Route::get('/', Index::class)->name('notification.index');
        Route::get('/create', Create::class)->name('notification.create');
        Route::get('/{notification}', Show::class)->name('notification.show');
    });
});

Route::group(['prefix' => 'assets'], function (): void {
    Route::get('notification-toast.js', fn (): BinaryFileResponse => AssetFileResponse::make('notification/index.js', false)->toFileResponse());
    Route::get('notification-toast.css', fn (): BinaryFileResponse => AssetFileResponse::make('notification/toast.css', false)->toFileResponse());
});
