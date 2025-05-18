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
    protected string $email;

    /**
     * Inject services via the constructor.
     *
     * @param UserAppService $userAppService
     * @param ApiProductService $apiProductService
     */
    public function __construct(UserAppService $userAppService, ApiProductService $apiProductService)
    {
        $this->userAppService = $userAppService;
        $this->apiProductService = $apiProductService;
        $this->email = auth()->user()->email;
    }

    /**
     * Display a listing of the user's apps.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $apps = $this->userAppService->all($this->email);
        return view('user.apps.index', compact('apps'));
    }

    /**
     * Show the form for creating a new app.
     *
     * @return \Illuminate\View\View
     */
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

    /**
     * Store a newly created app.
     *
     * @param NewAppRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(NewAppRequest $request)
    {
        $data = $request->validated();
        $data['name'] = str()->slug($data['name']);

        try {
            $this->userAppService->create($this->email, [
                'name' => $data['name'],
                'displayName' => $data['display_name'],
                'description' => $data['description'] ?? '',
                'callbackUrl' => $data['callback_url'],
                'apiProducts' => $data['api_product_ids'],
            ]);

            return redirect()->route('apps.index')->with('success', __('shadow.created_successfully', ['name' => __('shadow.app')]));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['name' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified app.
     *
     * @param string $id
     * @return \Illuminate\View\View|\Illuminate\Http\Response
     */
    public function show($id)
    {
        $app = $this->userAppService->find($this->email, $id);

        if (!$app) {
            abort(404);
        }

        $newKeyForm = Former::make([
            MultiSelect::make('api_products')
                ->setOptions($this->apiProductService->mine()->pluck('name', 'apigee_product_id')->toArray())
                ->required(),
        ])->setColumns(1)->setAction(route('apps.keys.store', $id));

        return view('user.apps.show', compact('app', 'newKeyForm'));
    }

    /**
     * Show the form for editing the specified app.
     *
     * @param string $id
     * @return \Illuminate\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $app = $this->userAppService->find($this->email, $id);
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

    /**
     * Update the specified app.
     *
     * @param UpdateAppRequest $request
     * @param string $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateAppRequest $request, $id)
    {
        $data = $request->validated();

        try {
            $this->userAppService->update($this->email, $id, [
                'displayName' => $data['display_name'],
                'description' => $data['description'] ?? '',
                'callbackUrl' => $data['callback_url'],
            ]);

            return redirect()->route('apps.show', $id)->with('success', __('shadow.updated_successfully', ['name' => __('shadow.app')]));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['name' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified app.
     *
     * @param string $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        try {
            $this->userAppService->delete($this->email, $id);
            return redirect()->route('apps.index')->with('success', __('shadow.deleted_successfully', ['name' => __('shadow.app')]));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Define the middleware for the controller.
     *
     * @return array
     */
    public static function middleware(): array
    {
        return [
            'auth',
            'verified',
        ];
    }
}
