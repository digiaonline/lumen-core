<?php namespace Nord\Lumen\Core\Domain\Model;

use InvalidArgumentException;
use Jenssegers\Date\Date;
use JMS\Serializer\Annotation as DTO;
use Nord\Lumen\Serializer\Facades\Serializer;

/**
 * @DTO\ExclusionPolicy("all")
 */
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
     * @var Date
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
        $this->setOccurredAt(Date::now());
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
     * @return Date
     */
    public function getOccurredAt()
    {
        return $this->occurredAt;
    }


    /**
     * @return array|null
     */
    public function getData()
    {
        $data = Serializer::toArray($this);

        return !empty($data) ? $data : null;
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
     * @param Date $occurredAt
     */
    private function setOccurredAt(Date $occurredAt)
    {
        $this->occurredAt = $occurredAt;
    }
}
