<?php namespace Nord\Lumen\Core\Domain\Model;

use Nord\Lumen\Core\Exception\ImmutableProperty;

trait HasIdentity
{

    /**
     * @var ObjectId
     */
    private $objectId;


    /**
     * @param ObjectId $objectId
     *
     * @return bool
     */
    public function compareObjectId(ObjectId $objectId)
    {
        return $this->objectId->getValue() === $objectId->getValue();
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
     * @param null|string $value
     *
     * @throws \Exception
     */
    private function createObjectId($value = null)
    {
        $this->setObjectId(new ObjectId($value));
    }


    /**
     * @param ObjectId $objectId
     */
    private function setObjectId(ObjectId $objectId)
    {
        if ($this->objectId !== null) {
            throw new ImmutableProperty('Object ID cannot be changed.');
        }

        $this->objectId = $objectId;
    }
}
