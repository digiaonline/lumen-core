<?php

namespace Nord\Lumen\Core\Debug;

use Exception;
use Illuminate\Http\Exception\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use League\OAuth2\Server\Exception\OAuthException;

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
     * @param Exception $exception
     *
     * @return Response
     */
    public function createResponse(Exception $exception)
    {
        $data   = $this->debug ? $this->extractExceptionData($exception) : 'Something went wrong.';
        $status = $this->resolveResponseStatusCode($exception);

        return new JsonResponse($data, $status, [], JSON_PARTIAL_OUTPUT_ON_ERROR);
    }

    /**
     * @param Exception $exception
     *
     * @return array
     */
    protected function extractExceptionData(Exception $exception)
    {
        return [
            'exception' => get_class($exception),
            'message'   => $exception->getMessage(),
            'code'      => $exception->getCode(),
            'file'      => $exception->getFile(),
            'line'      => $exception->getLine(),
            'trace'     => $exception->getTrace(),
        ];
    }

    /**
     * @param Exception $exception
     *
     * @return int
     */
    protected function resolveResponseStatusCode(Exception $exception)
    {
        if ($exception instanceof HttpResponseException) {
            return $exception->getCode();
        } else if ($exception instanceof OAuthException) {
            return $exception->httpStatusCode;
        } else {
            return 500;
        }
    }
}
