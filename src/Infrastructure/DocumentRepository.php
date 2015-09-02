<?php namespace Nord\Lumen\Core\Infrastructure;

use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\DocumentRepository as MongoDocumentRepository;
use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use Doctrine\ODM\MongoDB\UnitOfWork;

class DocumentRepository extends MongoDocumentRepository
{

    /**
     * @param DocumentManager $dm
     * @param UnitOfWork      $uow
     * @param ClassMetadata   $class
     */
    public function __construct(DocumentManager $dm, UnitOfWork $uow, ClassMetadata $class)
    {
        parent::__construct($dm, $uow, $class);
    }


    /**
     * @param $name
     *
     * @return object
     */
    public function findByName($name)
    {
        return $this->findOneBy(['name' => $name]);
    }


    /**
     * Get document by short ID
     *
     * @param $id
     *
     * @return object
     */
    public function findByShortId($id)
    {
        return $this->findOneBy(['shortId' => $id]);
    }


    /**
     * Get document(s) by a list of short IDs
     *
     * @param array $ids List of short IDs
     *
     * @return array
     */
    public function findByShortIdList($ids)
    {
        return $this->createQueryBuilder()
            ->field('shortId')
            ->in($ids)
            ->getQuery()
            ->execute()
            ->toArray();
    }
}
