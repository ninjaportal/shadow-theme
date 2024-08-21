<?php

namespace NinjaPortal\Shadow\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "email" => "required|email",
            "password" => "required",
            "g-recaptcha-response" => "recaptcha_v2"
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
