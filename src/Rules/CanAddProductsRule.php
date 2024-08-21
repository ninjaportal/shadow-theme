<?php

namespace NinjaPortal\Shadow\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Validation\Validator;
use NinjaPortal\Portal\Services\ApiProductService;

class CanAddProductsRule implements Rule
{
    public function passes($attribute, $value): bool
    {
        try {
            $apiProductIds = (new ApiProductService())->mine()->pluck('apigee_product_id');
            return $apiProductIds->diff($value)->isEmpty();
        } catch (\Exception $e) {
            return false;
        }
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
