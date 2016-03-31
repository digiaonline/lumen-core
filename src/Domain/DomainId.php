<?php

namespace Nord\Lumen\Core\Domain;

use Crisu83\ShortId\ShortId;
use Nord\Lumen\Core\Contracts\ValueObject;

class DomainId implements ValueObject
{
    /**
     * @var string
     */
    private $value;

    /**
     * @var \Crisu83\ShortId\ShortId
     */
    private static $identityGenerator;

    /**
     * DomainId constructor.
     *
     * @param string $value
     */
    public function __construct($value = null)
    {
        $this->value = $value === null ? $this->nextIdentity() : $value;
    }

    /**
     * @return string
     */
    private static function nextIdentity()
    {
        if (self::$identityGenerator === null) {
            self::$identityGenerator = ShortId::create();
        }

        return self::$identityGenerator->generate();
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getValue();
    }
}
