<?php

namespace NinjaPortal\Shadow\Controllers\Auth;

use App\Http\Controllers\Controller;
use NinjaPortal\Shadow\Former\Fields\ReCaptchaV2;
use NinjaPortal\Shadow\Former\Fields\TextInput;
use NinjaPortal\Shadow\Former\Former;
use NinjaPortal\Shadow\Requests\LoginRequest;

class LoginController extends Controller
{
    public function view()
    {
        $form = Former::make([
            TextInput::make('email')->setType('email'),
            TextInput::make('password')->setType('password'),
            ReCaptchaV2::make('recaptcha'),
        ])->setColumns(1);
        return view("auth.login", compact('form'));
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();
        $remember = $request->has('remember');
        if (auth()->attempt([
            'email' => $credentials['email'],
            'password' => $credentials['password'],
        ], $remember)) {
            $request->session()->regenerate();
            return redirect()->intended(route('home'));
        }
        return back()->withErrors([
            'email' => __('shadow.invalid_credentials'),
        ]);
    }

}
