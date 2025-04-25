<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\MarkNotificationAsViewedRequest;
use App\Models\NotificationRecipient;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

final class MarkNotificationAsViewedController extends Controller
{
    public function __invoke(MarkNotificationAsViewedRequest $request, int $id): JsonResponse
    {
        $validated = $request->validated();

        try {
            NotificationRecipient::where('id', $id)->update($validated);

            return response()->json([], Response::HTTP_NO_CONTENT);
        } catch (QueryException) {
            return response()->json([
                'status' => 'error',
                'message' => 'Não foi possivel marcar a notificação como vista',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
