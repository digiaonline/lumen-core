<?php namespace Nord\Lumen\Core\App;

use Doctrine\ORM\EntityManagerInterface;
use Nord\Lumen\Core\Domain\Model\Entity;

trait ManagesEntities
{

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;


    /**
     * @param Entity $entity
     */
    private function saveEntity(Entity $entity)
    {
        $this->entityManager->persist($entity);
    }


    /**
     * @param Entity $entity
     */
    private function saveEntityAndCommit(Entity $entity)
    {
        $this->entityManager->persist($entity);
        $this->commitEntities();
    }


    /**
     * @param Entity $entity
     */
    private function updateEntity(Entity $entity)
    {
        $this->entityManager->merge($entity);
    }


    /**
     * @param Entity $entity
     */
    private function updateEntityAndCommit(Entity $entity)
    {
        $this->entityManager->merge($entity);
        $this->commitEntities();
    }


    /**
     * @param Entity $entity
     */
    private function deleteEntity(Entity $entity)
    {
        $this->entityManager->remove($entity);
    }


    /**
     * @param Entity $entity
     */
    private function deleteEntityAndCommit(Entity $entity)
    {
        $this->entityManager->remove($entity);
        $this->commitEntities();
    }


    /**
     *
     */
    private function commitEntities()
    {
        $this->entityManager->flush();
    }


    /**
     * @param Entity $entity
     */
    private function refreshEntity(Entity $entity)
    {
        $this->entityManager->refresh($entity);
    }


    /**
     * @return EntityManagerInterface
     */
    private function getEntityManager()
    {
        return $this->entityManager;
    }


    /**
     * @param EntityManagerInterface $entityManager
     */
    private function setEntityManager($entityManager)
    {
        $this->entityManager = $entityManager;
    }
}
