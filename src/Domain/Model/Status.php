<?php namespace Nord\Lumen\Core\Domain\Model;

use InvalidArgumentException;

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
     */
    private function setValue($value)
    {
        if (! is_int($value)) {
            throw new InvalidArgumentException('Status must be an integer.');
        }

        $this->value = $value;
    }
}
