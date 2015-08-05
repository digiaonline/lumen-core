<?php namespace Nord\Lumen\Core\App;

use Doctrine\ODM\MongoDB\DocumentManager;
use Nord\Lumen\Core\Domain\Model\Document;

abstract class DocumentService
{

    /**
     * @var DocumentManager
     */
    protected $documentManager;


    /**
     * DocumentService constructor.
     *
     * @param DocumentManager $documentManager
     */
    public function __construct(DocumentManager $documentManager)
    {
        $this->documentManager = $documentManager;
    }


    /**
     * @param Document $document
     */
    protected function saveDocument(Document $document)
    {
        $this->documentManager->persist($document);
    }


    /**
     * @param Document $document
     */
    protected function saveDocumentAndCommit(Document $document)
    {
        $this->documentManager->persist($document);
        $this->commitDocuments();
    }


    /**
     * @param Document $document
     */
    protected function updateDocument(Document $document)
    {
        $this->documentManager->merge($document);
    }


    /**
     * @param Document $document
     */
    protected function updateDocumentAndCommit(Document $document)
    {
        $this->documentManager->merge($document);
        $this->commitDocuments();
    }


    /**
     * @param Document $document
     */
    protected function deleteDocument(Document $document)
    {
        $this->documentManager->remove($document);
    }


    /**
     * @param Document $document
     */
    protected function deleteDocumentAndCommit(Document $document)
    {
        $this->documentManager->remove($document);
        $this->commitDocuments();
    }


    /**
     *
     */
    protected function commitDocuments()
    {
        $this->documentManager->flush();
    }
}
