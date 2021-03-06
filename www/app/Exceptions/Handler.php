<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Session\TokenMismatchException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param \Exception $exception
     * @return void
     * @throws Exception
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param Request $request
     * @param Exception $exception
     * @return JsonResponse|\Illuminate\Http\Response|Response
     */
    public function render($request, Exception $exception)
    {
        if ($exception instanceof TokenMismatchException) {
            return response()->json([
                'error' => 'Form token is invalid! Reload the page and try your action again.',
                'status' => Response::HTTP_BAD_REQUEST
            ]);
        }

        if ($exception instanceof MethodNotAllowedHttpException) {
            return response()->json([
                'error' => 'Invalid URL provided! Reload the page and try your action again.',
                'status' => Response::HTTP_NOT_FOUND
            ]);
        }

        if ($exception instanceof NonExistentTaskException) {
            return response()->json([
                'error' => 'The issued task does not exist.',
                'status' => Response::HTTP_UNPROCESSABLE_ENTITY
            ]);
        }

        if ($exception instanceof ModelNotFoundException) {
            return response()->json([
                'error' => 'Sorry, the data source is temporarily unavailable.',
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR
            ]);
        }

        return parent::render($request, $exception);
    }
}
