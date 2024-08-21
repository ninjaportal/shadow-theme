<?php

namespace NinjaPortal\Shadow\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewAppRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "name" => "required|string",
            'display_name' => 'required|string',
            "description" => "string|nullable",
            "callback_url" => "nullable|url",
            "api_product_ids" => "required|array|can_add_products",
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
