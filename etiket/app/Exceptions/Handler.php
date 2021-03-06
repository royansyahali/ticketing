<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use App\Exceptions\InvalidOrderException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var string[]
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var string[]
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
           
        });

        $this->renderable(function (NotFoundHttpException $e, $request) {
            if (($request->header("content-type") == "application/json")) {
                return response()->json([
                    "code" => "404",
                    'status' => 'Record not found.'
                ], 404);
            }
        });
        
        $this->renderable(function (MethodNotAllowedHttpException $e, $request) {
            if (($request->header("content-type") == "application/json")) {
                return response()->json([
                    "code" => "405",
                    'status' => 'Method not allowed.'
                ], 405);
            }
        });
        

        
    }
}
