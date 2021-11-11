<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\RelationNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

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
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Throwable
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {

        // if ($this->isHttpException($exception)) {

        //     dd($exception);
		// 	if (view()->exists('errors.' . $exception->getStatusCode())) {

		// 		return response()->view('errors.' . $exception->getStatusCode(), $exception->getStatusCode(), $exception->getHeaders());
		// 	}
		// }


        if ($exception instanceof ModelNotFoundException) {
            //return response()->view('errors.404', ['error' => 'Model not found']);
            dd($exception);
            return response()->view('errors.404', ['error' => $exception->getMessage()]);
        }

        if ($exception instanceof RelationNotFoundException) {
            //dd($exception);
            return response()->view('errors.404',['error' => $instance]);
        }

        if ($exception instanceof NotFoundHttpException) {
            //dd($exception);
            return response()->view('errors.404',['error' => 'Request not found']);
        }

        return response()->view('errors.500',['error' => $exception->getMessage()]);
        //return parent::render($request, $exception);
    }
}
