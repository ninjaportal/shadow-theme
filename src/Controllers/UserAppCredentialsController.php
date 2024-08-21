<?php

namespace NinjaPortal\Shadow\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use NinjaPortal\Portal\Services\ApiProductService;
use NinjaPortal\Portal\Services\UserAppCredentialService;
use NinjaPortal\Portal\Services\UserAppService;
use NinjaPortal\Shadow\Requests\NewAppKeyRequest;

class UserAppCredentialsController extends Controller implements HasMiddleware
{

    protected readonly ApiProductService $apiProductService;
    protected readonly UserAppCredentialService $userAppCredentialService;
    protected readonly UserAppService $userAppService;

    public function __construct()
    {
        $this->userAppCredentialService = new UserAppCredentialService(
            auth()->user()->email,
            request()->route('id')
        );
        $this->userAppService = new UserAppService(auth()->user()->email);
    }

    public function store($id, NewAppKeyRequest $request)
    {
        $keys_per_app = config('shadow.keys_per_app');

        if (count($this->userAppService->find($id)->getCredentials()) >= $keys_per_app) {
            return redirect()->route('apps.show', ['id' => $id])
                ->with("error", "You have reached the maximum number of keys for this app");
        }

        $data = $request->validated();
        $this->userAppCredentialService->create($data['api_products']);
        return redirect()->route('apps.show', ['id' => $id])
            ->with("success", __("shadow.created_successfully", ["name" => __("shadow.key")]));
    }

    public function addProducts(NewAppKeyRequest $request, $id, $key)
    {
        $data = $request->validated();
        $this->userAppCredentialService->addProducts($key, $data['api_products']);
        return redirect()->route('apps.show', ['id' => $id])->with("success", __("shadow.updated_successfully", ["name" => __("shadow.key")]));
    }

    public function removeProducts(Request $request, $id, $key)
    {
        $data = $request->validate([
            'api_product' => 'required|string',
        ]);
        try {
            $this->userAppCredentialService->removeProducts($key, $data['api_product']);
        } catch (\Exception $e) {
            return redirect()->route('apps.show', ['id' => $id])->with("error", $e->getMessage());
        }
        return redirect()->route('apps.show', ['id' => $id])->with("success", __("shadow.updated_successfully", ["name" => __("shadow.key")]));
    }

    public function delete($id, $key)
    {
        try {
            $this->userAppCredentialService->delete($key);
            return redirect()->route('apps.show', ['id' => $id])
                ->with("success", __("shadow.deleted_successfully", ["name" => __("shadow.key")]));
        } catch (\Exception $e) {
            return redirect()->route('apps.show', ['id' => $id])
                ->with("error", $e->getMessage());
        }
    }

    public static function middleware()
    {
        return [
            'auth',
            'verified',
        ];
    }
}
