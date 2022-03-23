<?php

namespace App\Traits;

trait ResponseApi
{

    /**
     * @var array
     */
    private $response;

    /**
     * this method return api response
     *
     * @param string $message
     * @param null $data
     * @param integer $statusCode
     * @param boolean $isSuccess
     * @return \Illuminate\Http\JsonResponse
     */
    public function coreResponse($message, $data = null, $statusCode, $isSuccess = true)
    {
        # api result
        $result = [
            'status' => $statusCode,
            'data' => [
                "status" => $isSuccess ? "success" : "error",
                "message" => $message,
                "response" => $data
            ]
        ];

        # Send the response
        response()->json($result, $statusCode)->send();
        if (!$isSuccess) {
            die();
        }
    }

    /**
     * Send success response
     *
     * @param   string          $message
     * @param   array|object    $data
     * @param   integer         $statusCode
     */
    public  function success($message,$data = [], $statusCode = 200)
    {
        return $this->coreResponse($message, $data, $statusCode);
    }

     /**
     * Send error response
     *
     * @param   string          $message
     * @param   integer         $statusCode
     */
    public  function fail($message, $statusCode = 500)
    {
        return $this->coreResponse($message, null, $statusCode, false);
    }

}
