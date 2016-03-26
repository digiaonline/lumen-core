<?php namespace Nord\Lumen\Core\Infrastructure;

use Doctrine\ORM\EntityRepository as BaseRepository;
use Nord\Lumen\Core\Domain\Model\Entity;

class EntityRepository extends BaseRepository
{

    /**
     * @param string $domainId
     *
     * @return Entity|null
     */
    public function findByDomainId($domainId)
    {
        return $this->findOneBy(['domainId' => $domainId]);
    }


    /**
     * @param $domainId
     *
     * @return int
     */
    public function domainIdExists($domainId)
    {
        return (int) $this->createQueryBuilder('t')
            ->select('COUNT(t.domainId)')
            ->where('t.domainId = :domainId')
            ->setParameter('domainId', $domainId)
            ->getQuery()
            ->getSingleScalarResult();
    }
}
