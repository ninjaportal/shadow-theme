<?php

namespace NinjaPortal\Shadow\Controllers;

use App\Http\Controllers\Controller;
use NinjaPortal\Portal\Services\ApiProductService;

class PagesController extends Controller
{

    public function __construct(
        protected readonly ApiProductService $apiProductService
    ){}

    public function welcome()
    {
        $products = $this->apiProductService->public();
        return view('welcome', compact('products'));
    }

}
