<?php

declare(strict_types=1);

use App\Http\Controllers\V1\CreateNotificationController;
use App\Http\Controllers\V1\ListNotificationRecipientController;
use App\Http\Controllers\V1\MarkNotificationAsViewedController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1'], function (): void {
    Route::group(['prefix' => 'notifications'], function () {
        Route::post('/', CreateNotificationController::class);
        Route::get('/recipient/{id}', ListNotificationRecipientController::class)->whereNumber('id');
        Route::patch('/notification-recipient/{id}/mark-as-viewed', MarkNotificationAsViewedController::class)->whereNumber('id');
    });
});
