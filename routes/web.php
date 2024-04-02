<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\RoleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


        Route::get('/login', [\App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [\App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
        Route::get('/register', [\App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
        Route::post('/register', [\App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('register');
        Route::get('/logout', [\App\Http\Controllers\Auth\LoginController::class, "logout"])->name('logout');


        Route::get('/forget-password', [\App\Http\Controllers\Auth\LoginController::class, 'showForget'])->name('auth.forget-password');
        Route::post('/forget-password', [\App\Http\Controllers\Auth\LoginController::class, 'Forgethandler'])->name('auth.forget-password');
        Route::get('/reset-password/{token}', [\App\Http\Controllers\Auth\LoginController::class, 'showReset'])->name('password.reset');
        Route::post('/reset-password', [\App\Http\Controllers\Auth\LoginController::class, 'Resethandler'])->name('password.update');

        Route::get('/waiting',  [\App\Http\Controllers\Auth\LoginController::class, 'waiting'])->name('auth.waiting');

        Route::group(['middleware' => ['auth']], function () {
            Route::get('/',  [\App\Http\Livewire\Dashboard::class, '__invoke'])->name('home');
            Route::get('/dashboard',  [\App\Http\Livewire\Dashboard::class, '__invoke'])->name('dashboard');
            Route::get('/change-password',  [\App\Http\Livewire\ChangePassword::class, '__invoke'])->name('change.password');
            Route::get('/update-profile',  [\App\Http\Livewire\UpdateProfile::class, '__invoke'])->name('update.profile');
            Route::get('/update-client',  [\App\Http\Livewire\UpdateClient::class, '__invoke'])->name('update.client');
            Route::get('/edit-user',  [\App\Http\Livewire\Users\Edit::class, '__invoke'])->name('edit.user');
            Route::get('/services/{service}',  [\App\Http\Livewire\Users\Services\Detail::class, '__invoke'])->name('service.detail');
            Route::get('/users/{user}',  [\App\Http\Livewire\Users\Detail::class, '__invoke'])->name('user.detail');
            Route::get('/requests',  [\App\Http\Livewire\Requests\Index::class, '__invoke'])->name('requests');
            Route::get('/requests/{request}',  [\App\Http\Livewire\Requests\Detail::class, '__invoke'])->name('requests.detail');
            Route::get('/users',  [\App\Http\Livewire\Users\Index::class, '__invoke'])->name('index.user');
            Route::get('/skills',  [\App\Http\Livewire\Skills\Index::class, '__invoke'])->name('skills');
            Route::get('/find-pro',  [\App\Http\Livewire\Requests\Findpro\Index::class, '__invoke'])->name('findpro');
            Route::get('/bussiness',  [\App\Http\Livewire\Business\Index::class, '__invoke'])->name('business.index');
            Route::get('/dashboard',  [\App\Http\Livewire\Dashboard::class, '__invoke'])->name('admin.dashboard');
            Route::get('/portfolio/{portfolio}',  [\App\Http\Livewire\Users\Portfolio\Detail::class, '__invoke'])->name('portfolio.detail');

            Route::get('/categories', [\App\Http\Livewire\Categories\Index::class, '__invoke'])->name('categories');
            Route::get('/blogs', [\App\Http\Livewire\Blog\Index::class, '__invoke'])->name('blogs');
            Route::get('/blog/{blog}', [\App\Http\Livewire\Blog\Detail::class, '__invoke'])->name('blog.detail');
            Route::get('/testimonial', [\App\Http\Livewire\Testimonial\Index::class, '__invoke'])->name('testimonial');
            Route::get('/faq', [\App\Http\Livewire\Faq\Index::class, '__invoke'])->name('faqs.admin');

            Route::group(['as' => ''], function () {
                Route::resource('administrator', AdminController::class)->middleware(['permission:manage_administrators']);
                Route::resource('roles', RoleController::class)->middleware(['permission:manage_roles']);
                Route::get('permissions', [RoleController::class, 'permissions'])->name('roles.permissions')->middleware(['permission:manage_roles']);
                Route::get('assign_role',  [RoleController::class, 'rolesView'])->name('roles.assign')->middleware(['permission:manage_roles']);
                Route::post('assign_role',  [RoleController::class, 'rolesStore'])->name('roles.assign.post')->middleware(['permission:manage_roles']);
            });
    });

