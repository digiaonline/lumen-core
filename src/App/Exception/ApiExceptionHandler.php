<?php namespace Nord\Lumen\Core\App\Exception;

use Illuminate\Http\Exception\HttpResponseException;
use Illuminate\Http\JsonResponse;

class ApiExceptionHandler
{

    /**
     * @var bool
     */
    private $debug;


    /**
     * ApiExceptionHandler constructor.
     *
     * @param bool $debug
     */
    public function __construct($debug)
    {
        $this->debug = $debug;
    }


    /**
     * @param \Exception $exception
     *
     * @return JsonResponse
     */
    public function createResponse(\Exception $exception)
    {
        if ($this->debug) {
            $data = [
                'exception' => get_class($exception),
                'message' => $exception->getMessage(),
                'code' => $exception->getCode(),
                'file' => $exception->getFile(),
                'line' => $exception->getLine(),
                'trace' => $exception->getTrace(),
            ];
        } else {
            $data = ['message' => trans('errors.something_went_wrong')];
        }

        $status = $exception instanceof HttpResponseException ? $exception->getStatusCode() : 500;

        return new JsonResponse($data, $status, array(), JSON_PARTIAL_OUTPUT_ON_ERROR);
    }
}
