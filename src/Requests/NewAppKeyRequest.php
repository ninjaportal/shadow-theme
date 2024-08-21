<?php

namespace NinjaPortal\Shadow\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewAppKeyRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "api_products" => "required|array|can_add_products",
        ];
    }

    public function authorize(): bool
    {
        return auth()->check();
    }
}
