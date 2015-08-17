<?php namespace Nord\Lumen\Core\Domain\Model;

use JMS\Serializer\Annotation as DTO;
use Nord\Lumen\Doctrine\ODM\MongoDB\Domain\Model\ShortId;

abstract class IdentifiableDocumentObject implements DomainObject
{

    /**
     * @DTO\Expose
     * @DTO\Type("string")
     * @DTO\Accessor(getter="getShortIdValue")
     * @DTO\SerializedName("id")
     * @DTO\ReadOnly
     *
     * @var ShortId
     */
    protected $shortId;


    /**
     * IdentifiableDomainObject constructor.
     *
     * @param null|ShortId $shortId
     */
    public function __construct(ShortId $shortId = null)
    {
        $this->setShortId($shortId === null ? new ShortId : $shortId);
    }
    

    /**
     * @return ShortId
     */
    public function getShortId()
    {
        return $this->shortId;
    }


    /**
     * @return string
     */
    public function getShortIdValue()
    {
        return $this->getShortId()->getValue();
    }


    /**
     * @param ShortId $shortId
     */
    private function setShortId(ShortId $shortId)
    {
        $this->shortId = $shortId;
    }
}
