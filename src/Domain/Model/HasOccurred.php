<?php namespace Nord\Lumen\Core\Domain\Model;

use Carbon\Carbon;
use DateTime;

trait HasOccurred
{

    /**
     * @var DateTime
     */
    private $occurredAt;


    /**
     * @return DateTime
     */
    public function getOccurredAt()
    {
        return $this->occurredAt;
    }


    /**
     * @return int|null
     */
    public function getOccurredAtTimestamp()
    {
        return $this->occurredAt instanceof DateTime ? $this->occurredAt->getTimestamp() : null;
    }


    /**
     *
     */
    private function setOccurredAtToNow()
    {
        $this->setOccurredAt(Carbon::now());
    }


    /**
     * @param DateTime $occurredAt
     */
    private function setOccurredAt(DateTime $occurredAt)
    {
        $this->occurredAt = $occurredAt;
    }
}
