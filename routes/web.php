<?php

use Illuminate\Support\Facades\Route;
use NinjaPortal\Shadow\Controllers;

Route::middleware(['web',"set-locale"])->group(function () {
    Route::get('/', [Controllers\PagesController::class, 'welcome'])->name("home");

    Route::prefix("products")->group(function () {
        Route::get('/', [Controllers\ProductsController::class, 'index'])->name("products.index");
        Route::get('/{id}', [Controllers\ProductsController::class, 'show'])->name("products.show");
    });

    Route::group([
        "prefix" => "auth",
    ], function () {
        Route::get('/login', [Controllers\Auth\LoginController::class, 'view'])->name('login');
        Route::get('/register', [Controllers\Auth\RegisterController::class, 'view'])->name('register');

        Route::post('/login', [Controllers\Auth\LoginController::class, 'login']);
        Route::post('/register', [Controllers\Auth\RegisterController::class, 'register']);

        Route::post('/logout', [Controllers\UserController::class, 'logout'])->name('logout');

        Route::get('/forgot-password', [Controllers\Auth\ForgotPasswordController::class, 'view'])->name('password.request');
        Route::post('/forgot-password', [Controllers\Auth\ForgotPasswordController::class, 'sendResetLinkEmail']);

        Route::get('/reset-password/{token}', [Controllers\Auth\ResetPasswordController::class, 'view'])->name('password.reset');
        Route::post('/reset-password', [Controllers\Auth\ResetPasswordController::class, 'reset'])->name('password.update');

    });


    Route::prefix("apps")->middleware('auth:web')->group(function () {
        Route::get('/', [Controllers\UserAppsController::class, 'index'])->name("apps.index");
        Route::get('/create', [Controllers\UserAppsController::class, 'create'])->name("apps.create");
        Route::post('/create', [Controllers\UserAppsController::class, 'store'])->name("apps.store");
        Route::get('/{id}/edit', [Controllers\UserAppsController::class, 'edit'])->name("apps.edit");
        Route::put('/{id}/edit', [Controllers\UserAppsController::class, 'update'])->name("apps.update");

        Route::prefix('{id}/keys')->as("apps.keys.")->group(function () {
            Route::post("/create", [Controllers\UserAppCredentialsController::class, 'store'])->name("store");
            Route::post("/{key}/add-product", [Controllers\UserAppCredentialsController::class, 'addProducts'])->name("add-product");
            Route::post("/{key}/remove-product", [Controllers\UserAppCredentialsController::class, 'removeProducts'])->name("remove-product");
            Route::delete("/{key}/delete", [Controllers\UserAppCredentialsController::class, 'delete'])->name("delete");
        });

        Route::delete('/{id}', [Controllers\UserAppsController::class, 'destroy'])->name("apps.destroy");
        Route::get('/{id}', [Controllers\UserAppsController::class, 'show'])->name("apps.show");
    });

    Route::middleware('auth:web')->group(function () {
        Route::get('/profile', [Controllers\UserController::class, 'profile'])->name('profile');
        Route::post('/profile', [Controllers\UserController::class, 'updateProfile'])->name('profile.update');
        Route::post('/profile/password', [Controllers\UserController::class, 'updatePassword'])->name('profile.password');
    });

    Route::post('/logout', [Controllers\UserController::class, 'logout'])->name('logout');

    Route::get('/lang/{lang}', [Controllers\LanguageController::class, 'change'])->name('lang.change');
});
