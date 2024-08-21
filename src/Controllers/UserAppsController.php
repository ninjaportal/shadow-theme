<?php

namespace NinjaPortal\Shadow\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Routing\Controllers\HasMiddleware;
use Lordjoo\LaraApigee\Exceptions\NotFoundException;
use NinjaPortal\Portal\Services\ApiProductService;
use NinjaPortal\Portal\Services\UserAppService;
use NinjaPortal\Shadow\Former\Fields\MultiSelect;
use NinjaPortal\Shadow\Former\Fields\TextInput;
use NinjaPortal\Shadow\Former\Former;
use NinjaPortal\Shadow\Requests\NewAppRequest;
use NinjaPortal\Shadow\Requests\UpdateAppRequest;

class UserAppsController extends Controller implements HasMiddleware
{

    protected readonly UserAppService $userAppService;
    protected readonly ApiProductService $apiProductService;

    public function __construct()
    {
        $this->userAppService = new UserAppService(auth()->user()->email);
        $this->apiProductService = new ApiProductService();
    }

    public function index()
    {
        $apps = $this->userAppService->all();
        return view('user.apps.index', compact('apps'));
    }

    public function create()
    {
        $products = $this->apiProductService->mine()->pluck('name', 'apigee_product_id')->toArray();
        $form = Former::make([
            TextInput::make('name')->setHint('Name will be auto slugified and used as the app name in Apigee.')->required(),
            TextInput::make('display_name')->required(),
            TextInput::make('description'),
            TextInput::make('callback_url')->setType("url"),
            MultiSelect::make('api_product_ids')->setOptions($products)->required(),
        ])->setColumns(1);
        return view('user.apps.create', compact('form'));
    }

    public function store(NewAppRequest $request)
    {
        $data = $request->validated();
        $data['name'] = str()->slug($data['name']);
        try {
            $this->userAppService->create([
                'name' => $data['name'],
                'displayName' => $data['display_name'],
                'description' => $data['description'] ?? '',
                'callbackUrl' => $data['callback_url'],
                'apiProducts' => $data['api_product_ids'],
            ]);
            return redirect()->route('apps.index')->with('success', __('shadow.created_successfully', ['name' => __('shadow.created_successfully', ['name' => __('shadow.app')])]));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['name' => $e->getMessage()]);
        }
    }

    public function show($id)
    {
        $app = $this->userAppService->find($id);
        if (!$app)
            abort(404);
        $newKeyForm = Former::make([
            MultiSelect::make('api_products')->setOptions($this->apiProductService->mine()->pluck('name', 'apigee_product_id')->toArray())->required(),
        ])->setColumns(1)->setAction(route('apps.keys.store', $id));
        return view('user.apps.show', compact('app', 'newKeyForm'));
    }


    public function edit($id)
    {
        try {
            $app = $this->userAppService->find($id);
        } catch (NotFoundException $e) {
            abort(404);
        }

        $form = Former::make([
            TextInput::make('name')->disabled()->setHint('Name will be auto slugified and used as the app name in Apigee.')->required(),
            TextInput::make('display_name')->required(),
            TextInput::make('description'),
            TextInput::make('callback_url')->setType("url"),
        ])->setMethod('PUT')->setColumns(1);

        $form->fill([
            'name' => $app->getName(),
            'display_name' => $app->getDisplayName(),
            'description' => $app->getDescription(),
            'callback_url' => $app->getCallbackUrl(),
        ]);
        return view('user.apps.edit', compact('form', 'app'));
    }

    public function update(UpdateAppRequest $request, $id)
    {
        $data = $request->validated();
        try {
            $this->userAppService->update($id, [
                'displayName' => $data['display_name'],
                'description' => $data['description'] ?? '',
                'callbackUrl' => $data['callback_url'],
            ]);
            return redirect()->route('apps.show', $id)->with('success', __('shadow.updated_successfully', ['name' => __('shadow.app')]));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['name' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            $this->userAppService->delete($id);
            return redirect()->route('apps.index')->with('success', __('shadow.updated_successfully', ['name' => __('shadow.app')]));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public static function middleware(): array
    {
        return [
            'auth',
            'verified',
        ];
    }

}
