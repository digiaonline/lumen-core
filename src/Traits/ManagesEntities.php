<?php namespace Nord\Lumen\Core\Traits;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;

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
     * @param string $name
     */
    private function enableEntityFilter($name)
    {
        $this->getEntityManager()->getFilters()->enable($name);
    }


    /**
     * @param string $name
     */
    private function disableEntityFilter($name)
    {
        // For some weird reason the filter needs to be enabled first in order to be disabled.
        $this->getEntityManager()->getFilters()->enable($name);
        $this->getEntityManager()->getFilters()->disable($name);
    }


    /**
     * @param string $entityClassName
     *
     * @return ObjectRepository
     */
    private function getEntityRepository($entityClassName)
    {
        return $this->getEntityManager()->getRepository($entityClassName);
    }


    /**
     * @return EntityManagerInterface
     */
    private function getEntityManager()
    {
        return app(EntityManagerInterface::class);
    }
}
