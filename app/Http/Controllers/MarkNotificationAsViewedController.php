<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\NotificationRecipient;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MarkNotificationAsViewedController extends Controller
{
    public function __invoke(Request $request, int $id): JsonResponse
    {
        $validated = $request->validate([
            'viewed_at' => 'required|date',
            'ip_address' => 'required',
        ]);

        try {
            NotificationRecipient::query()->where('id', $id)->update($validated);

            return response()->json([], JsonResponse::HTTP_NO_CONTENT);
        } catch (QueryException $exception) {
            return response()->json([
                'status' => 'error',
                'message' => $exception->getMessage(),
            ]);
        }
    }
}
