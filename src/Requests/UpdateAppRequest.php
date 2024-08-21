<?php

namespace NinjaPortal\Shadow\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAppRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'display_name' => 'required|string',
            "description" => "string|nullable",
            "callback_url" => "nullable|url",
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
