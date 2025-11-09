<?php

namespace NinjaPortal\Shadow\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Validation\Validator;
use NinjaPortal\Portal\Contracts\Services\ApiProductServiceInterface;
use NinjaPortal\Portal\Services\ApiProductService;

class CanAddProductsRule implements Rule
{
    public function passes($attribute, $value): bool
    {
        try {
            $apiProductIds = app(ApiProductServiceInterface::class)->mine()->pluck('apigee_product_id');
            return $apiProductIds->intersect($value)->count() === count($value);
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
