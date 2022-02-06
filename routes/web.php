<?php

use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\PostController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Guest\CategoryController as GuestCategoryController;
use App\Http\Controllers\Guest\PostController as GuestPostController;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UploadController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::resource('/', PageController::class);

Route::get('/set', [LocalizationController::class, 'index'])->name('lang');
Route::post('/upload', [UploadController::class, 'upload'])->name('upload');

Route::middleware(['auth:sanctum', 'verified', 'team'])->group(function () {
    Route::prefix('dashboard')->group(function () {
        Route::get('/', DashboardController::class)->name('dashboard');
        Route::resource('post', PostController::class, [
            'names' => [
                'index' => 'dashboard.post.index',
                'show' => 'dashboard.post.show',
                'create' => 'dashboard.post.create',
                'store' => 'dashboard.post.store',
                'edit' => 'dashboard.post.edit',
                'update' => 'dashboard.post.update',
                'destroy' => 'dashboard.post.destroy',
            ]
        ])->scoped([
            'post' => 'slug'
        ]);
        Route::resource('category', CategoryController::class, [
            'names' => [
                'index' => 'dashboard.category.index',
                'show' => 'dashboard.category.show',
                'create' => 'dashboard.category.create',
                'store' => 'dashboard.category.store',
                'edit' => 'dashboard.category.edit',
                'update' => 'dashboard.category.update',
                'destroy' => 'dashboard.category.destroy',
            ]
        ])->scoped([
            'category' => 'slug'
        ]);
        Route::resource('user', UserController::class, [
            'names' => [
                'index' => 'dashboard.user.index',
                'show' => 'dashboard.user.show',
                'create' => 'dashboard.user.create',
                'store' => 'dashboard.user.store',
                'edit' => 'dashboard.user.edit',
                'update' => 'dashboard.user.update',
                'destroy' => 'dashboard.user.destroy',
            ]
        ])->scoped([
            'user' => 'email'
        ]);
    });
});

Route::resource('post', GuestPostController::class, [
    'names' => [
        'index' => 'guest.post.index',
        'show' => 'guest.post.show',
    ]
])->scoped([
    'post' => 'slug'
]);

Route::resource('category', GuestCategoryController::class, [
    'names' => [
        'index' => 'guest.category.index',
        'show' => 'guest.category.show',
    ]
])->scoped([
    'category' => 'slug'
]);
