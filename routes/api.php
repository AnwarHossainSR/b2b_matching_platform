<?php

use App\Http\Controllers\Api\Auth\ForgotPasswordController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\ResetPasswordController;
use App\Http\Controllers\Api\Blogs\CategoryController;
use App\Http\Controllers\Api\Blogs\CommentController;
use App\Http\Controllers\Api\Blogs\PostController;
use App\Http\Controllers\Api\Faqs\FaqController;
use App\Http\Controllers\Api\Notifications\EmailNotificationController;
use App\Http\Controllers\Api\PermissionsAndRoles\PermissionController;
use App\Http\Controllers\Api\PermissionsAndRoles\RoleController;
use App\Http\Controllers\Api\Profile\ChangePasswordController;
use App\Http\Controllers\Api\Profile\ProfileController;
use App\Http\Controllers\Api\Samples\SampleController;
use App\Http\Controllers\Api\Users\UserController;
use App\Http\Middleware\AuthGates;
use Illuminate\Support\Facades\Route;


Route::prefix('v1')->group(function () {
    Route::post('register', [Regis::class, 'register']);
    Route::post('forgot-password', [ForgotPasswordController::class, 'forgotPassword'])->name('password.forgot');
    Route::post('reset-password', [ResetPasswordController::class, 'resetPassword'])->name('password.reset');
    Route::post('login', [LoginController::class, 'login']);
    Route::get('/notifications/email', [EmailNotificationController::class, 'notify']);
    Route::get('/faqs', [FaqController::class, 'index']);
    Route::middleware(['auth:sanctum', AuthGates::class])->group(function () {
        Route::post('update-profile', [ProfileController::class, 'update']);
        Route::post('change-password', [ChangePasswordController::class, 'update']);
        Route::post('logout', [LoginController::class, 'logout']);
        Route::get('samples/list', [SampleController::class, 'list']);
        Route::get('users/list', [UserController::class, 'list']);
        Route::get('categories/{category:slug}', [CategoryController::class, 'show']);
        Route::get('posts/{post:slug}', [PostController::class, 'show']);
        Route::post('posts/{post:slug}/comments', [CommentController::class, 'store']);
        Route::post('posts/{post:slug}/comments/reply', [CommentController::class, 'storeReply']);

        // start resource based routes
        Route::apiResource('faqs', FaqController::class)->except(['index']);
        Route::apiResource('samples', SampleController::class);
        Route::apiResource('roles', RoleController::class);
        Route::apiResource('permissions', PermissionController::class);
        Route::apiResource('users', UserController::class);
        Route::apiResource('categories', CategoryController::class)->except(['index']);
        Route::apiResource('posts', PostController::class);
        // end resource based routes
    });
});
