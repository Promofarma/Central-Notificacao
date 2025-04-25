<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1;

use App\Actions\CreateNotification;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\NotificationCreateRequest;
use Illuminate\Database\QueryException;
use Illuminate\Http\Response;

final class CreateNotificationController extends Controller
{
    public function __invoke(NotificationCreateRequest $request, CreateNotification $action)
    {
        try {
            $validated = $request->validated();

            $notification = $action->handle($validated);

            return response()->json([
                'status' => 'success',
                'data' => $notification,
            ], Response::HTTP_CREATED);
        } catch (QueryException) {
            return response()->json([
                'status' => 'error',
                'message' => 'Não foi possível criar a notificação.',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
