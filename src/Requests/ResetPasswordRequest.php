<?php

namespace NinjaPortal\Shadow\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => "required|email",
            'password' => "required|confirmed|min:8",
            'token' => 'required|string',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
