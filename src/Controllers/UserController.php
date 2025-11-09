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
    return redirect()->back()->with('success', __('shadow::shadow.profile_updated'));
    }

    public function updatePassword(UserPasswordUpdateRequest $request)
    {
        $data = $request->validated();
        if (Hash::check($data['current_password'], auth()->user()->password)) {
            $this->userService->update(auth()->user(), ['password' => $data['password']]);
        } else {
            return redirect()->back()->with('error', __('shadow::shadow.password_incorrect'));
        }
        return redirect()->back()->with('success', __('shadow::shadow.password_updated'));
    }

    protected function updateProfileForm()
    {
        $form = Former::make([
            TextInput::make('first_name')
                ->setLabel(__('shadow::shadow.first_name'))
                ->setWrapperClass('lg:col-span-1')
                ->required(),
            TextInput::make('last_name')
                ->setLabel(__('shadow::shadow.last_name'))
                ->setWrapperClass('lg:col-span-1')
                ->required(),
            TextInput::make('email')
                ->setLabel(__('shadow::shadow.email'))
                ->setWrapperClass('lg:col-span-2')
                ->required(),
        ])->setColumns(2)
            ->setSubmitText(__('shadow::shadow.update'))
            ->setAction(route('profile.update'));
        $form->setClass('lg:gap-6');
        $form->fill(auth()->user()->toArray());
        return $form;
    }

    private function updatePasswordForm()
    {
        $form = Former::make([
            TextInput::make('current_password')
                ->setType('password')
                ->setLabel(__('shadow::shadow.current_password'))
                ->setWrapperClass('lg:col-span-2')
                ->required(),
            TextInput::make('password')
                ->setType('password')
                ->setLabel(__('shadow::shadow.new_password'))
                ->setWrapperClass('lg:col-span-1')
                ->required(),
            TextInput::make('password_confirmation')
                ->setType('password')
                ->setLabel(__('shadow::shadow.confirm_password'))
                ->setWrapperClass('lg:col-span-1')
                ->required(),
        ])
            ->setColumns(2)
            ->setSubmitText(__('shadow::shadow.update'))
            ->setAction(route('profile.password'));
        $form->setClass('lg:gap-6');

        return $form;
    }

    public static function middleware()
    {
        return ['auth:web'];
    }
}
