<?php

namespace App\Exceptions;

use App\Traits\ResponseApi;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{

    use ResponseApi;

    /**
     *
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * render exception
     * @param $request
     * @param Throwable $exception
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
     * @throws Throwable
     */

    public function render($request, Throwable $exception)
    {
        #send fail response for api
        if ($request->is('api/*')) {
            #handle exception for api requests
            $retval = $this->handleApiException($request, $exception);
            #end
        } else {
            $retval = parent::render($request, $exception);
        }
        return  $retval;
        #end
    }

    /**
     * handle exception
     * @param $request
     * @param Throwable $exception
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
     * @throws Throwable
     */

    private function handleApiException($request, Throwable $exception)
    {
        #show custom api response
        return $this->customApiResponse($request, $this->prepareException($exception));
    }

    /**
     * send api response based hhtp code
     * @param $request
     * @param Throwable $exception
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
     * @throws Throwable
     */

    private function customApiResponse($request, $exception)
    {

        #get status code for exception
        if (method_exists($exception, 'getStatusCode')) {
            $statusCode = $exception->getStatusCode();
        } else {
            $statusCode = 500;
        }
        #end

        #set message for status code
        switch ($statusCode) {
            case 401:
                $message = 'unauthorized';
                break;
            case 403:
                $message = 'forbidden';
                break;
            case 404:
                $message = 'not Found';
                break;
            case 405:
                $message = 'Method Not Allowed';
                break;
            case 501:
                $message = 'Not Implemented';
                break;
            case 503:
                $message = 'Service Unavailable';
                break;
            case 504:
                $message = 'Gateway Timeout';
                break;
            case 422:
                $message = 'Unprocessable Entity';
                break;
            default:
                $message = $exception->getMessage() ?? 'Internal Server Error';
                break;
        }
        #end

        #fail response
        return $this->fail(
            $message,
            $statusCode,
        );
        #end

    }

}
