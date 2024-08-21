<?php

namespace NinjaPortal\Shadow\Rules;

use GuzzleHttp\Client;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Validator;
use NinjaPortal\Portal\Services\ApiProductService;

class ReCaptchaV2Rule implements Rule
{
    public function passes($attribute, $value)
    {
        $is_enabled = config('shadow.recaptcha.enabled');

        if (!$is_enabled) {
            return true;
        }

        $secret_key = config('shadow.recaptcha.secret_key');

        $url = 'https://www.google.com/recaptcha/api/siteverify';

        $data = [
            'secret' => $secret_key,
            'response' => $value,
            'remoteip' => request()->ip(),
        ];

        $client = new Client();
        $response = $client->post($url, [
            'form_params' => $data,
        ]);

        $response = json_decode($response->getBody()->getContents(), true);

        return $response['success'];

    }

    public function message()
    {
        return __('validation.' . self::handle());
    }

    public static function handle(): string
    {
        return 'can_add_products';
    }

    public function validate(string $attribute, $value, $params, Validator $validator): bool
    {
        $handle = $this->handle();

        $validator->setCustomMessages([
            $handle => $this->message(),
        ]);

        return $this->passes($attribute, $value);
    }

}
