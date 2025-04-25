<?php

declare(strict_types=1);

use App\Helpers\AssetFileResponse;
use App\Http\Controllers\LogoutController;
use App\Livewire\Auth\Login;
use App\Livewire\Recipient\Index as RecipientIndex;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

Route::middleware('guest')->get('/', Login::class)->name('login');

Route::group(['prefix' => 'recipient'], function (): void {
    Route::get('/{recipient}', RecipientIndex::class)->whereNumber('recipient')->name('recipient');
});

Route::group(['middleware' => 'auth'], function (): void {
    Route::get('/logout', LogoutController::class)->name('logout');

    Route::redirect('/dashboard', '/notifications');

    Route::group(['prefix' => 'notifications'], base_path('routes/features/notification.php'));
    Route::group(['prefix' => 'groups'], routes: base_path('routes/features/group.php'));

    Route::group(['prefix' => 'users'], routes: base_path('routes/admin/user.php'));
    Route::group(['prefix' => 'recipients'], routes: base_path('routes/admin/recipient.php'));
    Route::group(['prefix' => 'teams'], routes: base_path('routes/admin/team.php'));
    Route::group(['prefix' => 'categories'], routes: base_path('routes/admin/category.php'));
    Route::group(['prefix' => 'roles'], routes: base_path('routes/admin/role.php'));
    Route::group(['prefix' => 'permissions'], routes: base_path('routes/admin/permission.php'));
});

Route::group(['prefix' => 'assets'], function (): void {
    Route::get('notification-toast.js', fn (): BinaryFileResponse => AssetFileResponse::make('notification/index.js', false)->toFileResponse());
    Route::get('notification-toast.css', fn (): BinaryFileResponse => AssetFileResponse::make('notification/toast.css', false)->toFileResponse());
});
