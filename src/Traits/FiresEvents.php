<?php namespace Nord\Lumen\Core\Traits;

use Illuminate\Contracts\Events\Dispatcher;

trait FiresEvents
{

    /**
     * @param string|object $event
     * @param array         $payload
     * @param bool|false    $halt
     *
     * @return array|null
     */
    private function fireEvent($event, $payload = [], $halt = false)
    {
        return $this->getEventDispatcher()->fire($event, $payload, $halt);
    }


    /**
     * @return Dispatcher
     */
    private function getEventDispatcher()
    {
        return app(Dispatcher::class);
    }
}
