<?php

namespace NinjaPortal\Shadow\Controllers\Auth;

use App\Http\Controllers\Controller;
use NinjaPortal\Portal\Services\UserService;
use NinjaPortal\Shadow\Former\Fields\HiddenInput;
use NinjaPortal\Shadow\Former\Fields\TextInput;
use NinjaPortal\Shadow\Former\Former;
use NinjaPortal\Shadow\Requests\ResetPasswordRequest;

class ResetPasswordController extends Controller
{

    public function __construct(
        protected readonly UserService $userService
    ) {}

    public function view($token)
    {
        $form = Former::make([
            HiddenInput::make('token')->setValue($token),
            TextInput::make('email')->setType('email')->required(),
            TextInput::make('password')->setType('password')->required(),
            TextInput::make('password_confirmation')->setType('password')->required(),
        ])->setColumns(1)->setAction(route('password.update'));
        return view('auth.passwords.reset', ['token' => $token, 'form' => $form]);
    }

    public function reset(ResetPasswordRequest $request)
    {
        $data = $request->validated();
        if ($this->userService->resetPassword($data['email'], $data['password'], $data['token'])) {
            return redirect()->route('login')->with('success', __('shadow.password_reset_link_sent'));
        }
        return redirect()->back()->with('error', __('shadow.password_reset_failed'));
    }

}
