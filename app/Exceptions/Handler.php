<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Arr;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }


    public function handleException($request, Exception $exception)
    {
        if($exception instanceof AuthenticationException && $request->expectsJson()) {
            $guard = Arr::get($exception->guards(), 0);
            if($guard == 'api') {
                return response()->json(['success' => false, 'message' => 'Authenticated Session has expired']);
            }
        }
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson() || $request->is('api/*')) {
            return response()->json([
                'success' => false,
                'message' => 'Your session has expired. Please login.'
            ]);
        }

        if ($request->is('admin') || $request->is('admin/*')) {
            return redirect()->guest('admin/login');
        }

        return redirect()->guest(route('login'));
    }
}
