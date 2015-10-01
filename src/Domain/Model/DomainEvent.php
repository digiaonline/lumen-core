<?php namespace Nord\Lumen\Core\Domain\Model;

use Nord\Lumen\Core\Exception\InvalidArgument;

class DomainEvent implements DomainObject
{

    use HasIdentity;
    use HasOccurred;

    /**
     * @var string
     */
    private $name;

    /**
     * @var array
     */
    private $payload;


    /**
     * DomainEvent constructor.
     *
     * @param string $channel
     * @param string $name
     */
    public function __construct($name, array $payload)
    {
        $this->createObjectId();
        $this->setName($name);
        $this->setPayload($payload);
        $this->setOccurredAtToNow();
    }


    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }


    /**
     * @return string
     */
    public function getPayload()
    {
        return $this->payload;
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


    /**
     * @param array $payload
     */
    private function setPayload(array $payload)
    {
        $this->payload = $payload;
    }
}
