<?php namespace Nord\Lumen\Core\Debug;

use Illuminate\Http\Exception\HttpResponseException;
use Illuminate\Http\JsonResponse;

class JsonExceptionHandler
{
    /**
     * @var bool
     */
    private $debug;

    /**
     * JsonExceptionHandler constructor.
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
                'message'   => $exception->getMessage(),
                'code'      => $exception->getCode(),
                'file'      => $exception->getFile(),
                'line'      => $exception->getLine(),
                'trace'     => $exception->getTrace(),
            ];
        } else {
            $data = 'Something went wrong.';
        }

        $status = $exception instanceof HttpResponseException ? $exception->getCode() : 500;

        return new JsonResponse($data, $status, [], JSON_PARTIAL_OUTPUT_ON_ERROR);
    }
}
