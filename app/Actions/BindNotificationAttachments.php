<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Notification;
use Illuminate\Support\Facades\Storage;

final class BindNotificationAttachments
{
    public function handle(Notification $notification, array $attachments): void
    {
        $formattedAttachments = $this->formatAttachments($attachments);

        $notification->attachments()->createMany($formattedAttachments);
    }

    private function formatAttachments(array $filePaths): array
    {
        return array_map(function (string $filePath) {
            $fileInfo = pathinfo($filePath);

            return [
                'file_name' => $fileInfo['basename'],
                'path' => $filePath,
                'extension' => $fileInfo['extension'],
                'size' => Storage::disk('public')->size($filePath),
            ];
        }, $filePaths);
    }
}
