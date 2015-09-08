<?php namespace Nord\Lumen\Core\App;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;
use Laravel\Lumen\Routing\Controller as BaseController;
use Symfony\Component\HttpFoundation\Response;

class Controller extends BaseController
{

    /**
     * @param mixed $data
     * @param int   $status
     * @param array $headers
     *
     * @return Response
     */
    protected function success($data = '', $status = 200, array $headers = [])
    {
        return new JsonResponse($data, $status, $headers);
    }


    /**
     * @param mixed $data
     * @param int   $status
     * @param array $headers
     *
     * @return Response
     */
    protected function error($data = '', $status = 400, array $headers = [])
    {
        return new JsonResponse($data, $status, $headers);
    }


    /**
     * @param string|null $message
     *
     * @return Response
     */
    protected function badRequest($message = null)
    {
        return $this->errorWithMessage($message !== null ? $message : 'ERROR.BAD_REQUEST', 400);
    }


    /**
     * @param string|null $message
     *
     * @return Response
     */
    protected function accessDenied($message = null)
    {
        return $this->errorWithMessage($message !== null ? $message : 'ERROR.ACCESS_DENIED', 401);
    }


    /**
     * @param string|null $message
     *
     * @return Response
     */
    protected function forbidden($message = null)
    {
        return $this->errorWithMessage($message !== null ? $message : 'ERROR.FORBIDDEN', 403);
    }


    /**
     * @param string|null $message
     *
     * @return Response
     */
    protected function notFound($message = null)
    {
        return $this->errorWithMessage($message !== null ? $message : 'ERROR.NOT_FOUND', 404);
    }


    /**
     * @param string|null $message
     *
     * @return Response
     */
    protected function unprocessableEntity($message = null)
    {
        return $this->errorWithMessage($message !== null ? $message : 'ERROR.UNPROCESSABLE_ENTITY', 422);
    }


    /**
     * @param string|null $message
     *
     * @return Response
     */
    protected function fatalError($message = null)
    {
        return $this->errorWithMessage($message !== null ? $message : 'ERROR.FATAL_ERROR', 500);
    }


    /**
     * @inheritdoc
     */
    protected function buildFailedValidationResponse(Request $request, array $errors)
    {
        return new JsonResponse($errors, 422);
    }


    /**
     * @inheritdoc
     */
    protected function formatValidationErrors(Validator $validator)
    {
        return [
            'message' => trans('errors.validation'),
            'errors'  => $validator->errors()->getMessages(),
        ];
    }


    /**
     * @param  mixed $message
     * @param int    $status
     * @param array  $headers
     *
     * @return Response
     */
    private function errorWithMessage($message, $status = 400, array $headers = [])
    {
        return $this->error(['message' => $message], $status, $headers);
    }


    /**
     * @param Request $request
     * @param string  $key
     *
     * @return bool
     */
    protected function hasRequestParam(Request $request, $key)
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
    protected function getRequestParam(Request $request, $key, $default = null)
    {
        return array_get($request->all(), $key, $default);
    }
}
