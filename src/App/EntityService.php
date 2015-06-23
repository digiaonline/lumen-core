<?php namespace Nord\Lumen\Core\App;

use Doctrine\ORM\EntityManager;
use Eventello\Domain\Model\Entity;

abstract class EntityService
{

    /**
     * @var EntityManager
     */
    protected $entityManager;


    /**
     * EntityService constructor.
     *
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    /**
     * @param Entity $entity
     */
    protected function saveEntity(Entity $entity)
    {
        $this->entityManager->persist($entity);
    }


    /**
     * @param Entity $entity
     */
    protected function updateEntity(Entity $entity)
    {
        $this->entityManager->merge($entity);
    }


    /**
     * @param Entity $entity
     */
    protected function deleteEntity(Entity $entity)
    {
        $this->entityManager->remove($entity);
    }


    /**
     * @param mixed $entity
     */
    protected function commitEntity($entity)
    {
        $this->entityManager->flush($entity);
    }
}
