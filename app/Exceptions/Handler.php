<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function render($request, Exception $exception)
    {
        if ($exception) {
            $response = response()->json([
                    'status' => 'error',
                    'data' => $exception->getMessage()
                ]);
            if($exception instanceof NotFoundHttpException) {
                $response = response()->json([
                    'status' => 'error',
                    'data' => 'Page not found, sorry for that :('
                ])->setStatusCode(404);
            } elseif ($exception instanceof MethodNotAllowedHttpException) {
                $response = response()->json([
                    'status' => 'error',
                    'data' => 'This method isn\'t allowed'
                ])->setStatusCode(405);
            }

            return $response->setEncodingOptions(JSON_PRETTY_PRINT);
        }

        return parent::render($request, $exception);
    }
}
