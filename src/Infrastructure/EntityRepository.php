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


    /**
     * @param $objectId
     *
     * @return int
     */
    public function objectIdExists($objectId)
    {
        return (int) $this->createQueryBuilder('t')
            ->select('COUNT(t.objectId)')
            ->where('t.objectId = :objectId')
            ->setParameter('objectId', $objectId)
            ->getQuery()
            ->getSingleScalarResult();
    }
}
