<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\CreateNotification;
use App\Http\Requests\NotificationCreateRequest;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;

class NotificationController extends Controller
{
    public function store(NotificationCreateRequest $request, CreateNotification $action): JsonResponse
    {
        try {
            $validated = $request->validated();

            $notification = $action->handle($validated);

            return response()->json([
                'status' => 'success',
                'data' => $notification,
            ], JsonResponse::HTTP_CREATED);
        } catch (QueryException) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error creating notification',
            ]);
        }
    }
}
