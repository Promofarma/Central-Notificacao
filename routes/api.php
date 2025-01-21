<?php

declare(strict_types=1);

use App\Http\Controllers\MarkNotificationAsViewedController;
use App\Http\Controllers\NotificationRecipientController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1'], function (): void {
    Route::group(['prefix' => 'notification'], function () {
        Route::get('/recipient/{recipient_id}', NotificationRecipientController::class)->whereNumber('recipient_id');
        Route::patch('/recipient/{id}/mark-as-viewed', MarkNotificationAsViewedController::class)->whereNumber('id');
    });
});
