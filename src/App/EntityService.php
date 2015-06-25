<?php namespace Nord\Lumen\Core\App;

use Doctrine\ORM\EntityManagerInterface;
use Nord\Lumen\Core\Domain\Model\Entity;

abstract class EntityService
{

    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;


    /**
     * EntityService constructor.
     *
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
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
     *
     */
    protected function commitEntities()
    {
        $this->entityManager->flush($entity);
    }
}
