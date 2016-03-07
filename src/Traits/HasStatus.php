<?php

namespace Nord\Lumen\Core\Traits;

use Nord\Lumen\Core\Domain\Status;

trait HasStatus
{

    /**
     * @var Status
     */
    private $status;


    /**
     * @return Status
     */
    public function getStatus()
    {
        return $this->status;
    }


    /**
     * @return int
     */
    public function getStatusValue()
    {
        return $this->status->getValue();
    }


    /**
     * @param Status $status
     */
    private function setStatus(Status $status)
    {
        $this->status = $status;
    }
}
