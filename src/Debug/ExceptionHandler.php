<?php namespace Nord\Lumen\Core\Debug;

use Exception;
use Laravel\Lumen\Exceptions\Handler;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ExceptionHandler extends Handler
{

    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        HttpException::class,
    ];


    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception $e
     *
     * @return void
     */
    public function report(Exception $e)
    {
        parent::report($e);
    }


    /**
     * @inheritdoc
     */
    public function render($request, Exception $e)
    {
        $handler = new JsonExceptionHandler(env('APP_DEBUG', false));

        return $handler->createResponse($e);
    }
}
