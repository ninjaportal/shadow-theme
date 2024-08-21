<?php

namespace NinjaPortal\Shadow\Controllers;

use App\Http\Controllers\Controller;
use NinjaPortal\Portal\Services\ApiProductService;

class ProductsController extends Controller
{

    public function __construct(
        protected readonly ApiProductService $apiProductService
    ) {}

    public function index()
    {
        if (!auth()->check())
            $products = $this->apiProductService->public();

        if (auth()->check())
            $products = $this->apiProductService->mine();

        return view('products.index', compact('products'));
    }

    public function show($id)
    {
        $product = $this->apiProductService->find($id);
        if (!auth()->check() && $product->visibility !== 'public') {
            abort(404);
        }

        if (auth()->check()) {
            $user_audiences = auth()->user()->audiences->pluck('id');
            if ($product->audiences->isNotEmpty() && $product->audiences->pluck('id')->diff($user_audiences)->isNotEmpty()) {
                abort(404);
            }
        }

        return view('products.show', compact('product'));
    }

}
