<?php namespace Nord\Lumen\Core\App;

use Nord\Lumen\Core\Domain\Model\Document;
use Nord\Lumen\Doctrine\ODM\MongoDB\DocumentManagerInterface;

abstract class DocumentService
{

    /**
     * @var DocumentManagerInterface
     */
    protected $documentManager;


    /**
     * DocumentService constructor.
     *
     * @param DocumentManagerInterface $documentManager
     */
    public function __construct(DocumentManagerInterface $documentManager)
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
