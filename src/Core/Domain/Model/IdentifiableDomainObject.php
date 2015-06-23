<?php namespace Nord\Lumen\Core\Domain\Model;

use JMS\Serializer\Annotation as DTO;

abstract class IdentifiableDomainObject implements DomainObject
{

    /**
     * @DTO\Expose
     * @DTO\Type("string")
     * @DTO\Accessor(getter="getObjectIdValue")
     * @DTO\SerializedName("id")
     * @DTO\ReadOnly
     *
     * @var ObjectId
     */
    protected $objectId;


    /**
     * IdentifiableDomainObject constructor.
     *
     * @param null|ObjectId $objectId
     */
    public function __construct(ObjectId $objectId = null)
    {
        $this->setObjectId($objectId === null ? new ObjectId : $objectId);
    }


    /**
     * @param IdentifiableDomainObject $other
     *
     * @return bool
     */
    public function equals(IdentifiableDomainObject $other)
    {
        return $this->getObjectIdValue() === $other->getObjectIdValue();
    }


    /**
     * @return ObjectId
     */
    public function getObjectId()
    {
        return $this->objectId;
    }


    /**
     * @return string
     */
    public function getObjectIdValue()
    {
        return $this->getObjectId()->getValue();
    }


    /**
     * @param ObjectId $objectId
     */
    private function setObjectId(ObjectId $objectId)
    {
        $this->objectId = $objectId;
    }
}
