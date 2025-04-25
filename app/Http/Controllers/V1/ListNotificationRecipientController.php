<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1;

use App\Filters\NotificationRecipientFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\NotificationRecipientRequest;
use App\Http\Resources\NotificationRecipientResource;
use App\Models\NotificationRecipient;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

final class ListNotificationRecipientController extends Controller
{
    public function __invoke(NotificationRecipientRequest $request, int $id): JsonResponse
    {
        $validated = $request->validated();

        $validated['recipient_id'] = $id;

        $recipients = NotificationRecipient::query()
            ->select([
                'id',
                'notification_uuid',
                'recipient_id',
                'viewed_at',
                'readed_at',
                'created_at',
            ])
            ->with([
                'notification' => fn ($query) => $query
                    ->select([
                        'uuid',
                        'title',
                        'user_id',
                        'category_id',
                        'scheduled_date',
                        'scheduled_time',
                        'created_at',
                    ])
                    ->with('user:id,name'),
            ])
            ->filter(new NotificationRecipientFilter($validated))
            ->orderBy('created_at', 'desc')
            ->get();

        $resources = NotificationRecipientResource::collection($recipients);

        return response()->json([
            'status' => 'success',
            'data' => $resources,
            'total' => $recipients->count(),
        ], Response::HTTP_OK);
    }
}
