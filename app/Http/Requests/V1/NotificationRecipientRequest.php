<?php

declare(strict_types=1);

namespace App\Http\Requests\V1;

use App\Enums\NotificationRecipientReadStatus;
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
            'read_status' => [Rule::enum(NotificationRecipientReadStatus::class)],
        ];
    }
}
