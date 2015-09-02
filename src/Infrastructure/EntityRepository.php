<?php namespace Nord\Lumen\Core\Infrastructure;

use Nord\Lumen\Core\Domain\Model\Entity;

class EntityRepository extends \Doctrine\ORM\EntityRepository
{

    /**
     * @param string $objectId
     *
     * @return Entity|null
     */
    public function findByObjectId($objectId)
    {
        return $this->findOneBy(['objectId' => $objectId]);
    }
}
