<?php

namespace NinjaPortal\Shadow\Controllers\Auth;

use Exception;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use NinjaPortal\Portal\Services\UserService;
use NinjaPortal\Shadow\Former\Fields\TextInput;
use NinjaPortal\Shadow\Former\Former;
use NinjaPortal\Shadow\Requests\RegisterRequest;

class RegisterController extends Controller
{


    public function __construct(
        protected readonly UserService $userService
    ) {}


    public function view()
    {
        $form = Former::make([
            TextInput::make('first_name'),
            TextInput::make('last_name'),
            TextInput::make('email')->setWrapperClass('col-span-2'),
            TextInput::make('password')->setWrapperClass('col-span-2')->setType('password'),
        ]);
        return view("auth.register", compact('form'));
    }


    public function register(RegisterRequest $request)
    {
        $data = $request->validated();
        return DB::transaction(function () use ($data, $request) {
            try {
                $user = $this->userService->create($data);
            } catch (Exception $e) {
                Log::error($e->getMessage());
                return redirect()->back()->with(['status' => 'error', 'message'  => __("shadow.general_error")]);
            }

            auth()->login($user, true);
            $request->session()->regenerate();
            return redirect()->route('home');
        });
    }


}
