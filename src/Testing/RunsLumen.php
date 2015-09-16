<?php namespace Nord\Lumen\Core\Testing;

use Illuminate\Support\Facades\Facade;
use Laravel\Lumen\Application;
use Nord\Lumen\Core\Exception\FatalError;

trait RunsLumen
{

    /**
     * @var string
     */
    private $applicationPath;

    /**
     * @var Application
     */
    private $application;


    /**
     * Refresh the application instance.
     */
    private function refreshApplication()
    {
        $this->application = $this->createApplication();

        Facade::clearResolvedInstances();
    }


    /**
     * Creates the application.
     *
     * @return Application
     */
    private function createApplication()
    {
        if ($this->applicationPath === null) {
            throw new FatalError('Application path is not set.');
        }

        return require $this->applicationPath;
    }


    /**
     * Starts the application.
     */
    private function startApplication()
    {
        if (!$this->application) {
            $this->refreshApplication();
        }
    }


    /**
     * Stops the application.
     */
    private function stopApplication()
    {
        if ($this->application) {
            $this->application->flush();

            $this->application = null;
        }
    }


    /**
     * @param string $command
     * @param array  $parameters
     *
     * @return int
     */
    private function runArtisan($command, $parameters = [])
    {
        return $this->application['Illuminate\Contracts\Console\Kernel']->call($command, $parameters);
    }


    /**
     * Sets the application path.
     *
     * @param string $applicationPath
     */
    private function setApplicationPath($applicationPath)
    {
        $this->applicationPath = $applicationPath;
    }
}
