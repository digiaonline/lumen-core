<?php namespace Nord\Lumen\Core\Domain\Model;

use JMS\Serializer\Annotation as DTO;

/**
 * @DTO\ExclusionPolicy("all")
 */
abstract class EntityEvent extends DomainEvent
{

    /**
     * @var null|string
     */
    private $entityId;


    /**
     * EntityEvent constructor.
     *
     * @param string      $channel
     * @param string      $name
     * @param null|string $entityId
     */
    public function __construct($channel, $name, $entityId)
    {
        parent::__construct($channel, $name);

        $this->setEntityId($entityId);
    }


    /**
     * @return null|string
     */
    public function getEntityId()
    {
        return $this->entityId;
    }


    /**
     * @param null|string $entityId
     */
    private function setEntityId($entityId)
    {
        $this->entityId = $entityId;
    }
}
