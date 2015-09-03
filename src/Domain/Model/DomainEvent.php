<?php namespace Nord\Lumen\Core\Domain\Model;

use JMS\Serializer\Annotation as DTO;
use Nord\Lumen\Core\Exception\InvalidArgument;

/**
 * @DTO\ExclusionPolicy("all")
 */
class DomainEvent implements DomainObject
{

    use HasIdentity;
    use HasOccurred;

    /**
     * @var string
     */
    private $channel;

    /**
     * @var string
     */
    private $name;


    /**
     * DomainEvent constructor.
     *
     * @param string $channel
     * @param string $name
     */
    public function __construct($channel, $name)
    {
        $this->createObjectId();
        $this->setChannel($channel);
        $this->setName($name);
        $this->setOccurredAtToNow();
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
     * @param string $channel
     *
     * @throws InvalidArgument
     */
    private function setChannel($channel)
    {
        if (empty($channel)) {
            throw new InvalidArgument('Event channel cannot be empty.');
        }

        $this->channel = $channel;
    }


    /**
     * @param string $name
     *
     * @throws InvalidArgument
     */
    private function setName($name)
    {
        if (empty($name)) {
            throw new InvalidArgument('Event name cannot be empty.');
        }

        $this->name = $name;
    }
}
