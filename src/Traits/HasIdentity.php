<?php

namespace Nord\Lumen\Core\Traits;

use Nord\Lumen\Core\Domain\DomainId;
use Nord\Lumen\Core\Exceptions\ImmutableProperty;

trait HasIdentity
{

    /**
     * @var DomainId
     */
    private $domainId;


    /**
     * @param DomainId $domainId
     *
     * @return bool
     */
    public function compareDomainId(DomainId $domainId)
    {
        return $this->domainId->getValue() === $domainId->getValue();
    }


    /**
     * @return DomainId
     */
    public function getDomainId()
    {
        return $this->domainId;
    }


    /**
     * @return string
     */
    public function getDomainIdValue()
    {
        return $this->getDomainId()->getValue();
    }


    /**
     * @param null|string $value
     *
     * @throws \Exception
     */
    private function createDomainId($value = null)
    {
        $this->setDomainId(new DomainId($value));
    }


    /**
     * @param DomainId $domainId
     */
    private function setDomainId(DomainId $domainId)
    {
        if ($this->domainId !== null) {
            throw new ImmutableProperty('Domain ID cannot be changed.');
        }

        $this->domainId = $domainId;
    }
}
