<?php namespace Nord\Lumen\Core\Domain\Model;

use DateTime;
use InvalidArgumentException;
use Nord\Lumen\Serializer\Facades\Serializer;

abstract class DomainEvent implements DomainObject
{

    /**
     * @var ObjectId
     */
    private $eventId;

    /**
     * @var string
     */
    private $channel;

    /**
     * @var string
     */
    private $name;

    /**
     * @var DateTime
     */
    private $occurredAt;


    /**
     * DomainEvent constructor.
     *
     * @param string $channel
     * @param string $name
     */
    public function __construct($channel, $name)
    {
        $this->setEventId(new ObjectId);
        $this->setChannel($channel);
        $this->setName($name);
        $this->setOccurredAt(Carbon::now());
    }


    /**
     * @return string
     */
    public function getEventIdValue()
    {
        return $this->eventId->getValue();
    }


    /**
     * @return string
     */
    public function getChannel()
    {
        return $this->channel;
    }


    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }


    /**
     * @return DateTime
     */
    public function getOccurredAt()
    {
        return $this->occurredAt;
    }


    /**
     * @return array|null
     */
    public function getPayload()
    {
        $payload = Serializer::toArray($this);

        return !empty($payload) ? $payload : null;
    }


    /**
     * @param ObjectId $eventId
     */
    private function setEventId($eventId)
    {
        $this->eventId = $eventId;
    }


    /**
     * @param string $channel
     */
    private function setChannel($channel)
    {
        if (empty($channel)) {
            throw new InvalidArgumentException('Event channel cannot be empty.');
        }

        $this->channel = $channel;
    }


    /**
     * @param string $name
     */
    private function setName($name)
    {
        if (empty($name)) {
            throw new InvalidArgumentException('Event name cannot be empty.');
        }

        $this->name = $name;
    }


    /**
     * @param DateTime $occurredAt
     */
    private function setOccurredAt(DateTime $occurredAt)
    {
        $this->occurredAt = $occurredAt;
    }
}
