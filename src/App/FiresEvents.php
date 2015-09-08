<?php namespace Nord\Lumen\Core\App;

use Illuminate\Contracts\Events\Dispatcher;

trait FiresEvents
{

    /**
     * @var Dispatcher
     */
    private $eventDispatcher;


    /**
     * @param string|object $event
     * @param array         $payload
     * @param bool|false    $halt
     */
    private function fireEvent($event, $payload = [], $halt = false)
    {
        $this->eventDispatcher->fire($event, $payload, $halt);
    }


    /**
     * @return Dispatcher
     */
    private function getEventDispatcher()
    {
        return $this->eventDispatcher;
    }


    /**
     * @param Dispatcher $eventDispatcher
     */
    private function setEventDispatcher($eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }
}
