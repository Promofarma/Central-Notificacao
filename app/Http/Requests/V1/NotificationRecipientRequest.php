<?php

declare(strict_types=1);

namespace App\Http\Requests\V1;

use App\Enums\NotificationRecipientReadStatus;
use App\Enums\NotificationType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class NotificationRecipientRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'type' => ['nullable', 'string', Rule::enum(NotificationType::class)],
            'read_status' => [Rule::enum(NotificationRecipientReadStatus::class)],
        ];
    }
}
