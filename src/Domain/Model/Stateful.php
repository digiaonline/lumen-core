<?php namespace Nord\Lumen\Core\Domain\Model;

trait Stateful
{

    /**
     * @var Status
     */
    private $status;


    /**
     * @param Status $status
     */
    protected function setStatus(Status $status)
    {
        $this->status = $status;
    }


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
}
