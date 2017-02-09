<?php

namespace Nord\Lumen\Core\Debug;

use Exception;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use League\OAuth2\Server\Exception\OAuthException;
use Symfony\Component\HttpKernel\Exception\HttpException;

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
        $data   = $this->createResponseData($exception);
        $status = $this->resolveResponseStatusCode($exception);

        return new JsonResponse($data, $status, [], JSON_PARTIAL_OUTPUT_ON_ERROR);
    }

    /**
     * @param Exception $exception
     *
     * @return array
     */
    protected function createResponseData(Exception $exception)
    {
        return $this->debug
            ? $this->extractExceptionData($exception)
            : $this->createDefaultResponseData($exception);
    }

    /**
     * @param Exception $exception
     *
     * @return array
     */
    protected function extractExceptionData(Exception $exception)
    {
        $data = [
            'exception' => get_class($exception),
            'message'   => $exception->getMessage(),
            'code'      => $exception->getCode(),
            'file'      => $exception->getFile(),
            'line'      => $exception->getLine(),
            'trace'     => []
        ];

        foreach ($exception->getTrace() as $item) {
            if (isset($item['args']) && is_array($item['args'])) {
                $item['args'] = $this->cleanTraceArgs($item['args']);
            }
            $data['trace'][] = $item;
        }

        return $data;
    }

    /**
     * @param Exception $exception
     *
     * @return array
     */
    protected function createDefaultResponseData(Exception $exception)
    {
        $statusCode = $this->resolveResponseStatusCode($exception);
        if ($statusCode === 404) {
            return ['message' => 'Sorry, the page you are looking for could not be found.'];
        } else {
            return ['message' => 'Whoops, looks like something went wrong.'];
        }
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
        } elseif ($exception instanceof HttpException) {
            return $exception->getStatusCode();
        } elseif ($exception instanceof OAuthException) {
            return $exception->httpStatusCode;
        } else {
            return 500;
        }
    }

    /**
     * @param array $args
     * @param int   $level
     * @param int   $count
     *
     * @return array
     */
    private function cleanTraceArgs(array $args, $level = 0, &$count = 0)
    {
        $result = array();

        foreach ($args as $key => $value) {
            if (++$count > 1e4) {
                return '*SKIPPED over 10000 entries*';
            }
            if (is_object($value)) {
                $result[$key] = get_class($value);
            } elseif (is_array($value)) {
                if ($level > 10) {
                    $result[$key] = '*DEEP NESTED ARRAY*';
                } else {
                    $result[$key] = $this->cleanTraceArgs($value, $level + 1, $count);
                }
            } elseif (is_null($value)) {
                $result[$key] = null;
            } elseif (is_bool($value)) {
                $result[$key] = $value;
            } elseif (is_int($value)) {
                $result[$key] = $value;
            } elseif (is_resource($value)) {
                $result[$key] = get_resource_type($value);
            } elseif ($value instanceof \__PHP_Incomplete_Class) {
                $array = new \ArrayObject($value);
                $result[$key] = $array['__PHP_Incomplete_Class_Name'];
            } else {
                $result[$key] = (string)$value;
            }
        }

        return $result;
    }
}
