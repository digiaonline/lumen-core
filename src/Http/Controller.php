<?php namespace Nord\Lumen\Core\Http;

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
    protected function success($data = [], $status = 200, array $headers = [])
    {
        return new JsonResponse($data, $status, $headers);
    }


    /**
     * @param array $data
     * @param int   $status
     * @param array $headers
     *
     * @return Response
     */
    protected function error($data = [], $status = 400, array $headers = [])
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
        return $this->errorWithMessage($message !== null ? $message : trans('errors.bad_request'), 400);
    }


    /**
     * @param string|null $message
     *
     * @return Response
     */
    protected function accessDenied($message = null)
    {
        return $this->errorWithMessage($message !== null ? $message : trans('errors.access_denied'), 401);
    }


    /**
     * @param string|null $message
     *
     * @return Response
     */
    protected function forbidden($message = null)
    {
        return $this->errorWithMessage($message !== null ? $message : trans('errors.forbidden'), 403);
    }


    /**
     * @param string|null $message
     *
     * @return Response
     */
    protected function notFound($message = null)
    {
        return $this->errorWithMessage($message !== null ? $message : trans('errors.not_found'), 404);
    }


    /**
     * @param string|null $message
     *
     * @return Response
     */
    protected function unprocessableEntity($message = null)
    {
        return $this->errorWithMessage($message !== null ? $message : trans('errors.unprocessable_entity'), 422);
    }


    /**
     * @param string|null $message
     *
     * @return Response
     */
    protected function fatalError($message = null)
    {
        return $this->errorWithMessage($message !== null ? $message : trans('errors.fatal_error'), 500);
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
}
