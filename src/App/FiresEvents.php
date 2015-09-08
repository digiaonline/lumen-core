<?php namespace Nord\Lumen\Core\App;

use Illuminate\Contracts\Events\Dispatcher;

trait FiresEvents
{

    /**
     * @param string|object $event
     * @param array         $payload
     * @param bool|false    $halt
     */
    private function fireEvent($event, $payload = [], $halt = false)
    {
        $this->getEventDispatcher()->fire($event, $payload, $halt);
    }


    /**
     * @return Dispatcher
     */
    private function getEventDispatcher()
    {
        return app(Dispatcher::class);
    }
}
