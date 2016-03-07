<?php namespace Nord\Lumen\Core\Traits;

use Illuminate\Http\Exception\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

trait CreatesHttpResponses
{

    /**
     * @param mixed $resource
     * @param array $data
     * @param array $headers
     *
     * @return JsonResponse
     */
    private function resourceOkResponse($resource, array $data = [], array $headers = [])
    {
        return $this->okResponse(array_merge(['data' => $resource], $data), $headers);
    }


    /**
     * @param mixed $resource
     * @param array $data
     * @param array $headers
     *
     * @return JsonResponse
     */
    private function resourceCreatedResponse($resource, array $data = [], array $headers = [])
    {
        return $this->createdResponse(array_merge(['data' => $resource], $data), $headers);
    }


    /**
     * @param mixed $data
     * @param array $metadata
     * @param array $headers
     *
     * @return JsonResponse
     */
    private function okResponse($data = null, array $headers = [])
    {
        return $this->successResponse($data, 200, $headers);
    }


    /**
     * @param mixed $data
     * @param array $metadata
     * @param array $headers
     *
     * @return JsonResponse
     */
    private function createdResponse($data = null, array $headers = [])
    {
        return $this->successResponse($data, 201, $headers);
    }


    /**
     * @param string $message
     * @param array  $metadata
     * @param array  $headers
     *
     * @return JsonResponse
     */
    private function badRequestResponse($message, $metadata = [], array $headers = [])
    {
        return $this->errorResponse($message, $metadata, 400, $headers);
    }


    /**
     * @param string $message
     * @param array  $metadata
     * @param array  $headers
     *
     * @throws HttpResponseException
     */
    private function throwBadRequest($message, $metadata = [], array $headers = [])
    {
        throw new HttpResponseException($this->badRequestResponse($message, $metadata, $headers));
    }


    /**
     * @param string $message
     * @param array  $metadata
     * @param array  $headers
     *
     * @return JsonResponse
     */
    private function accessDeniedResponse($message, $metadata = [], array $headers = [])
    {
        return $this->errorResponse($message, $metadata, 401, $headers);
    }


    /**
     * @param string $message
     * @param array  $data
     * @param array  $headers
     *
     * @throws HttpResponseException
     */
    private function throwAccessDenied($message, $data = [], array $headers = [])
    {
        throw new HttpResponseException($this->accessDeniedResponse($message, $data, $headers));
    }


    /**
     * @param string $message
     * @param array  $data
     * @param array  $headers
     *
     * @return JsonResponse
     */
    private function forbiddenResponse($message, $data = [], array $headers = [])
    {
        return $this->errorResponse($message, $data, 403, $headers);
    }


    /**
     * @param string $message
     * @param array  $data
     * @param array  $headers
     *
     * @throws HttpResponseException
     */
    private function throwForbidden($message, $data = [], array $headers = [])
    {
        throw new HttpResponseException($this->forbiddenResponse($message, $data, $headers));
    }


    /**
     * @param string $message
     * @param array  $data
     * @param array  $headers
     *
     * @return JsonResponse
     */
    private function notFoundResponse($message, $data = [], array $headers = [])
    {
        return $this->errorResponse($message, $data, 404, $headers);
    }


    /**
     * @param string $message
     * @param array  $data
     * @param array  $headers
     *
     * @throws HttpResponseException
     */
    private function throwNotFound($message, $data = [], array $headers = [])
    {
        throw new HttpResponseException($this->notFoundResponse($message, $data, $headers));
    }


    /**
     * @param string $message
     * @param array  $data
     * @param array  $headers
     *
     * @return JsonResponse
     */
    private function unprocessableEntityResponse($message, $data = [], array $headers = [])
    {
        return $this->errorResponse($message, $data, 422, $headers);
    }


    /**
     * @param string $message
     * @param array  $data
     * @param array  $headers
     *
     * @throws HttpResponseException
     */
    private function throwUnprocessableEntity($message, $data = [], array $headers = [])
    {
        throw new HttpResponseException($this->unprocessableEntityResponse($message, $data, $headers));
    }


    /**
     * @param string $message
     * @param array  $data
     * @param array  $headers
     *
     * @return JsonResponse
     */
    private function fatalErrorResponse($message, $data = [], array $headers = [])
    {
        return $this->errorResponse($message, $data, 500, $headers);
    }


    /**
     * @param string $message
     * @param array  $data
     * @param array  $headers
     *
     * @throws HttpResponseException
     */
    private function throwFatalError($message, $data = [], array $headers = [])
    {
        throw new HttpResponseException($this->fatalErrorResponse($message, $data, $headers));
    }


    /**
     * @param string $message
     * @param array  $errors
     * @param array  $data
     * @param int    $status
     * @param array  $headers
     *
     * @return JsonResponse
     */
    private function validationFailedResponse(
        $message,
        array $errors,
        array $data,
        $status = 422,
        array $headers = []
    ) {
        return $this->errorResponse($message, array_merge($data, ['errors' => $errors]), $status, $headers);
    }


    /**
     * @param string $message
     * @param array  $errors
     * @param array  $data
     * @param int    $status
     * @param array  $headers
     *
     * @throws HttpResponseException
     */
    private function throwValidationFailed($message, array $errors, $data = [], $status = 422, array $headers = [])
    {
        throw new HttpResponseException(
            $this->validationFailedResponse($message, $errors, $data, $status, $headers));
    }


    /**
     * @param array $data
     * @param array $metadata
     * @param int   $status
     * @param array $headers
     *
     * @return JsonResponse
     */
    private function successResponse($data = null, $status = 200, array $headers = [])
    {
        return new JsonResponse($data, $status, $headers);
    }


    /**
     * @param string $message
     * @param array  $data
     * @param int    $status
     * @param array  $headers
     *
     * @return JsonResponse
     */
    private function errorResponse($message, $data = [], $status = 400, array $headers = [])
    {
        return new JsonResponse(array_merge(['message' => $message], $data), $status, $headers);
    }


    /**
     * @param Request $request
     * @param string  $key
     *
     * @return bool
     */
    private function hasRequestParam(Request $request, $key)
    {
        return $this->getRequestParam($request, $key) !== null;
    }


    /**
     * @param Request $request
     * @param string  $key
     * @param mixed   $default
     *
     * @return mixed
     */
    private function getRequestParam(Request $request, $key, $default = null)
    {
        return array_get($request->all(), $key, $default);
    }
}
