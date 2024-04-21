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
            Route::get('/edit-user',  [\App\Http\Livewire\Users\Edit::class, '__invoke'])->name('edit.user');
            Route::get('/users/{user}',  [\App\Http\Livewire\Users\Detail::class, '__invoke'])->name('user.detail');
            Route::get('/users',  [\App\Http\Livewire\Users\Index::class, '__invoke'])->name('index.user');
            Route::get('/trip',  [\App\Http\Livewire\Trip\Index::class, '__invoke'])->name('trip.index');
            Route::get('/constants',  [\App\Http\Livewire\Constant\Index::class, '__invoke'])->name('constant.index');
            Route::get('/trip/{trip}',  [\App\Http\Livewire\Trip\Detail::class, '__invoke'])->name('trip.detail');
            Route::get('/evaluate/{trip}',  [\App\Http\Livewire\Trip\Evaluate::class, '__invoke'])->name('trip.evaluate');
            Route::get('/dashboard',  [\App\Http\Livewire\Dashboard::class, '__invoke'])->name('admin.dashboard');
    });