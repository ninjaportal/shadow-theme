<?php

namespace NinjaPortal\Shadow\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Hash;
use NinjaPortal\Portal\Services\UserService;
use NinjaPortal\Shadow\Former\Fields\TextInput;
use NinjaPortal\Shadow\Former\Former;
use NinjaPortal\Shadow\Requests\UserPasswordUpdateRequest;
use NinjaPortal\Shadow\Requests\UserProfileUpdateRequest;

class UserController extends Controller implements HasMiddleware
{

    public function __construct(
        protected readonly UserService $userService
    ){}

    public function profile()
    {
        $updateProfileForm = $this->updateProfileForm();
        $updatePasswordForm = $this->updatePasswordForm();
        return view('user.profile.index', compact('updateProfileForm', 'updatePasswordForm'));
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('home');
    }

    public function updateProfile(UserProfileUpdateRequest $request)
    {
        $data = $request->validated();
        $this->userService->update(auth()->user(), $data);
        return redirect()->back()->with('success', __('shadow.profile_updated'));
    }

    public function updatePassword(UserPasswordUpdateRequest $request)
    {
        $data = $request->validated();
        if (Hash::check($data['current_password'], auth()->user()->password)) {
            $this->userService->update(auth()->user(), ['password' => $data['password']]);
        } else {
            return redirect()->back()->with('error', __('shadow.password_incorrect'));
        }
        return redirect()->back()->with('success', __('shadow.password_updated'));
    }

    protected function updateProfileForm()
    {
        $form = Former::make([
            TextInput::make('first_name')->setLabel(__('First Name'))->required(),
            TextInput::make('last_name')->setLabel(__('Last Name'))->required(),
            TextInput::make('email')->setLabel(__('Email'))->required(),
        ])->setColumns(1)
            ->setSubmitText(__('Update'))
            ->setAction(route('profile.update'));
        $form->fill(auth()->user()->toArray());
        return $form;
    }

    private function updatePasswordForm()
    {
        return Former::make([
            TextInput::make('current_password')
                ->setType('password')
                ->setLabel(__('Current Password'))
                ->required(),
            TextInput::make('password')
                ->setType('password')
                ->setLabel(__('New Password'))
                ->required(),
            TextInput::make('password_confirmation')
                ->setType('password')
                ->setLabel(__('Confirm Password'))
                ->required(),
        ])
            ->setColumns(1)
            ->setSubmitText(__('Update'))
            ->setAction(route('profile.password'));
    }

    public static function middleware()
    {
        return ['auth:web'];
    }
}
