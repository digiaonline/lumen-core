<?php

namespace Nord\Lumen\Core\Domain;

use Nord\Lumen\Core\Contracts\ValueObject;
use Nord\Lumen\Core\Exceptions\InvalidArgument;

class Status implements ValueObject
{
    /**
     * @var int
     */
    private $value;

    /**
     * Status constructor.
     *
     * @param int $value
     */
    public function __construct($value)
    {
        $this->setValue($value);
    }

    /**
     * @return int
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param int $value
     *
     * @throws InvalidArgument
     */
    private function setValue($value)
    {
        if (!is_int($value)) {
            throw new InvalidArgument('Status must be an integer.');
        }

        $this->value = $value;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string) $this->getValue();
    }
}
