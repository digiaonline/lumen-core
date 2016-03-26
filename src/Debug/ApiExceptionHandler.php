<?php namespace Nord\Lumen\Core\Debug;

use Illuminate\Http\Exception\HttpResponseException;
use Illuminate\Http\JsonResponse;

class ApiExceptionHandler
{

    /**
     * @param \Exception $exception
     *
     * @return JsonResponse
     */
    public function createResponse(\Exception $exception)
    {
        $data = [
            'exception' => get_class($exception),
            'message'   => $exception->getMessage(),
            'code'      => $exception->getCode(),
            'file'      => $exception->getFile(),
            'line'      => $exception->getLine(),
            'trace'     => $exception->getTrace(),
        ];

        return new JsonResponse($data, $status, [], JSON_PARTIAL_OUTPUT_ON_ERROR);
    }
}
