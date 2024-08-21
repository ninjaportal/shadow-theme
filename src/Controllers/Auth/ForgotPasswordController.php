<?php

namespace NinjaPortal\Shadow\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Password;
use NinjaPortal\Portal\Services\UserService;
use NinjaPortal\Shadow\Former\Fields\TextInput;
use NinjaPortal\Shadow\Former\Former;
use NinjaPortal\Shadow\Requests\ForgetPasswordRequest;

class ForgotPasswordController extends Controller implements HasMiddleware
{

    public function __construct(
        protected readonly UserService $userService
    ) {}

    public function view()
    {
        $form = Former::make([
            TextInput::make("email")->setType("email")->required()
        ])->setColumns(1);
        return view("auth.passwords.email", compact("form"));
    }

    public function sendResetLinkEmail(ForgetPasswordRequest $request)
    {
        $data = $request->validated();
        try {
            $this->userService->requestPasswordReset($data["email"]);
            return redirect()->route("login")->with("success", __("shadow.password_reset_success"));
        } catch (\Exception $e) {
            return redirect()->back()->with("error", __("shadow.password_reset_failed"));
        }
    }


    public static function middleware()
    {
        return [
            "guest"
        ];
    }
}
