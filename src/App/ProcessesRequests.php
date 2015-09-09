<?php namespace Nord\Lumen\Core\App;

use Illuminate\Http\Exception\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

trait ProcessesRequests
{

    /**
     * @param mixed $data
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
     * @param array $headers
     *
     * @return JsonResponse
     */
    private function createdResponse($data = null, array $headers = [])
    {
        return $this->successResponse($data, 201, $headers);
    }


    /**
     * @param mixed $data
     * @param array $headers
     *
     * @return JsonResponse
     */
    private function badRequestResponse($data = null, array $headers = [])
    {
        return $this->errorResponse($data, 400, $headers);
    }


    /**
     * @param mixed $data
     * @param array $headers
     *
     * @throws HttpResponseException
     */
    private function throwBadRequest($data = null, array $headers = [])
    {
        throw new HttpResponseException($this->badRequestResponse($data, $headers));
    }


    /**
     * @param mixed $data
     * @param array $headers
     *
     * @return JsonResponse
     */
    private function accessDeniedResponse($data = null, array $headers = [])
    {
        return $this->errorResponse($data, 401, $headers);
    }


    /**
     * @param mixed $data
     * @param array $headers
     *
     * @throws HttpResponseException
     */
    private function throwAccessDenied($data = null, array $headers = [])
    {
        throw new HttpResponseException($this->accessDeniedResponse($data, $headers));
    }


    /**
     * @param mixed $data
     * @param array $headers
     *
     * @return JsonResponse
     */
    private function forbiddenResponse($data = null, array $headers = [])
    {
        return $this->errorResponse($data, 403, $headers);
    }


    /**
     * @param mixed $data
     * @param array $headers
     *
     * @throws HttpResponseException
     */
    private function throwForbidden($data = null, array $headers = [])
    {
        throw new HttpResponseException($this->forbiddenResponse($data, $headers));
    }


    /**
     * @param mixed $data
     * @param array $headers
     *
     * @return JsonResponse
     */
    private function notFoundResponse($data = null, array $headers = [])
    {
        return $this->errorResponse($data, 404, $headers);
    }


    /**
     * @param mixed $data
     * @param array $headers
     *
     * @throws HttpResponseException
     */
    private function throwNotFound($data = null, array $headers = [])
    {
        throw new HttpResponseException($this->notFoundResponse($data, $headers));
    }


    /**
     * @param mixed $data
     * @param array $headers
     *
     * @return JsonResponse
     */
    private function unprocessableEntityResponse($data = null, array $headers = [])
    {
        return $this->errorResponse($data, 400, $headers);
    }


    /**
     * @param mixed $data
     * @param array $headers
     *
     * @throws HttpResponseException
     */
    private function throwUnprocessableEntity($data = null, array $headers = [])
    {
        throw new HttpResponseException($this->unprocessableEntityResponse($data, $headers));
    }


    /**
     * @param mixed $data
     * @param array $headers
     *
     * @return JsonResponse
     */
    private function fatalErrorResponse($data = null, array $headers = [])
    {
        return $this->errorResponse($data, 500, $headers);
    }


    /**
     * @param mixed $data
     * @param array $headers
     *
     * @throws HttpResponseException
     */
    private function throwFatalError($data = null, array $headers = [])
    {
        throw new HttpResponseException($this->fatalErrorResponse($data, $headers));
    }


    /**
     * @param string $message
     * @param array  $errors
     * @param int    $status
     * @param array  $headers
     *
     * @return JsonResponse
     */
    private function validationFailedResponse($message, array $errors, $status = 422, array $headers = [])
    {
        return $this->errorResponse(['message' => $message, 'errors' => $errors], $status, $headers);
    }


    /**
     * @param string $message
     * @param array  $errors
     * @param int    $status
     * @param array  $headers
     *
     * @throws HttpResponseException
     */
    private function throwValidationFailed($message, array $errors, $status = 422, array $headers = [])
    {
        throw new HttpResponseException($this->validationFailedResponse($message, $errors, $status, $headers));
    }


    /**
     * @param mixed $data
     * @param int   $status
     * @param array $headers
     *
     * @return JsonResponse
     */
    private function successResponse($data = null, $status = 200, array $headers = [])
    {
        return new JsonResponse($this->normalizeData($data), $status, $headers);
    }


    /**
     * @param mixed $data
     * @param int   $status
     * @param array $headers
     *
     * @return JsonResponse
     */
    private function errorResponse($data = null, $status = 400, array $headers = [])
    {
        return new JsonResponse($this->normalizeData($data), $status, $headers);
    }


    /**
     * @param mixed $data
     *
     * @return array
     */
    private function normalizeData($data)
    {
        return is_string($data) ? ['message' => $data] : $data;
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
