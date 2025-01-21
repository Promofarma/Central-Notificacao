<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Enums\NotificationRecipientReadStatus;
use App\Enums\NotificationRecipientViewedStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class NotificationRecipientRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'read_status' => [Rule::enum(NotificationRecipientReadStatus::class)],
            'viewed_status' => [Rule::enum(NotificationRecipientViewedStatus::class)],
        ];
    }
}
