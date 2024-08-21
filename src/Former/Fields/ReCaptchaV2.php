<?php

namespace NinjaPortal\Shadow\Former\Fields;

use NinjaPortal\Shadow\Former\BaseInput;

class ReCaptchaV2 extends BaseInput
{

    protected string $view = "shadow::former.inputs.captcahV2";

    public function getSiteKey(): string
    {
        return config('shadow.recaptcha.site_key');
    }

    public function isEnabled(): bool
    {
        return config('shadow.recaptcha.enabled');
    }

}
