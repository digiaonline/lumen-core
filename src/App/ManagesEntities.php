<?php namespace Nord\Lumen\Core\App;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Nord\Lumen\Core\Domain\Model\Entity;

trait ManagesEntities
{

    /**
     * @param mixed $entity
     */
    private function saveEntity($entity)
    {
        $this->getEntityManager()->persist($entity);
    }


    /**
     * @param mixed $entity
     */
    private function saveEntityAndCommit($entity)
    {
        $this->saveEntity($entity);
        $this->commitEntities();
    }


    /**
     * @param mixed $entity
     */
    private function updateEntity($entity)
    {
        $this->getEntityManager()->merge($entity);
    }


    /**
     * @param mixed $entity
     */
    private function updateEntityAndCommit($entity)
    {
        $this->updateEntity($entity);
        $this->commitEntities();
    }


    /**
     * @param mixed $entity
     */
    private function deleteEntity($entity)
    {
        $this->getEntityManager()->remove($entity);
    }


    /**
     * @param mixed $entity
     */
    private function deleteEntityAndCommit($entity)
    {
        $this->deleteEntity($entity);
        $this->commitEntities();
    }


    /**
     *
     */
    private function commitEntities()
    {
        $this->getEntityManager()->flush();
    }


    /**
     * @param mixed $entity
     */
    private function refreshEntity($entity)
    {
        $this->getEntityManager()->refresh($entity);
    }


    /**
     * @param string $className
     *
     * @return ObjectRepository
     */
    private function getEntityRepository($className)
    {
        return $this->getEntityManager()->getRepository($className);
    }


    /**
     * @return EntityManagerInterface
     */
    private function getEntityManager()
    {
        return app(EntityManagerInterface::class);
    }
}
