<?php namespace Nord\Lumen\Core\Handlers;

use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Nord\Lumen\Cors\Contracts\CorsService;

class Handler extends ExceptionHandler
{

    /**
     * @var CorsService
     */
    private $corsService;


    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
    ];


    /**
     * Handler constructor.
     */
    public function __construct(CorsService $corsService)
    {
        $this->corsService = $corsService;
    }


    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception $e
     *
     * @return void
     */
    public function report(\Exception $e)
    {
        parent::report($e);
    }


    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception               $e
     *
     * @return \Illuminate\Http\Response
     */
    public function render($request, \Exception $e)
    {
        $handler = new ApiExceptionHandler(env('APP_DEBUG', false));

        $response = $handler->createResponse($e);

        return $this->corsService->handleRequest($request, $response);
    }
}
