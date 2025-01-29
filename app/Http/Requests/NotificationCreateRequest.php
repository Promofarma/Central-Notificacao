<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NotificationCreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:60',
            'content' => 'required|string',
            'category_id' => 'required|int|exists:categories,id',
            'user_id' => 'required|int|exists:users,id',
            'recipient_ids' => 'required|array|min:1',
            'recipient_ids.*' => 'required|int|exists:recipients,id',
        ];
    }
}
