<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Filters\NotificationRecipientFilter;
use App\Http\Requests\NotificationRecipientRequest;
use App\Http\Resources\NotificationRecipientResource;
use App\Models\NotificationRecipient;
use Illuminate\Http\JsonResponse;

class NotificationRecipientController extends Controller
{
    public function __invoke(NotificationRecipientRequest $request, int $recipientId): JsonResponse
    {
        $recipients = NotificationRecipient::query()
            ->select([
                'id',
                'notification_uuid',
                'viewed_at',
                'readed_at',
                'created_at',
            ])
            ->with([
                'notification' => fn ($query) => $query
                    ->select([
                        'uuid',
                        'title',
                        'content',
                        'user_id',
                        'scheduled_at',
                        'created_at',
                    ])
                    ->with('user:id,name'),
            ])
            ->where('recipient_id', $recipientId)
            ->filter(new NotificationRecipientFilter($request->validated()))
            ->get();

        $resources = NotificationRecipientResource::collection($recipients);

        return response()->json([
            'status' => JsonResponse::HTTP_OK,
            'data' => $resources,
        ]);
    }
}
