<?php

namespace NinjaPortal\Shadow\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "first_name" => "required|string",
            "last_name" => "required|string",
            "email" => "required|email",
            "password" => "required|string",
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
