<?php namespace Nord\Lumen\Core\Infrastructure;

use InvalidArgumentException;

class FilterSpec
{

    const TYPE_EQUALS = 'eq';
    const TYPE_NOT_EQUALS = 'neq';
    const TYPE_GREATER_THAN = 'gt';
    const TYPE_LESS_THAN = 'lt';
    const TYPE_GREATER_OR_EQUAL_THAN = 'gte';
    const TYPE_LESS_OR_EQUAL_THAN = 'lte';
    const TYPE_FREE_TEXT = 'ft';
    const TYPE_STARTS_WITH = 'sw';
    const TYPE_ENDS_WITH = 'ew';
    const TYPE_BETWEEN = 'between';
    const TYPE_JOIN = 'join';

    /**
     * @var string
     */
    private $property;

    /**
     * @var string
     */
    private $value;

    /**
     * @var string
     */
    private $type;

    /**
     * @var array
     */
    private $validTypes = [
        self::TYPE_EQUALS,
        self::TYPE_NOT_EQUALS,
        self::TYPE_GREATER_THAN,
        self::TYPE_LESS_THAN,
        self::TYPE_GREATER_OR_EQUAL_THAN,
        self::TYPE_LESS_OR_EQUAL_THAN,
        self::TYPE_FREE_TEXT,
        self::TYPE_STARTS_WITH,
        self::TYPE_ENDS_WITH,
        self::TYPE_BETWEEN,
        self::TYPE_JOIN,
    ];


    /**
     * FilterSpec constructor.
     *
     * @param string $property
     * @param string $value
     */
    public function __construct($property, $value)
    {
        $this->setProperty($property);
        $this->parseValue($value);
    }


    /**
     * @return string
     */
    public function getProperty()
    {
        return $this->property;
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
    public function getType()
    {
        return $this->type;
    }


    /**
     * @param string $property
     */
    private function setProperty($property)
    {
        if (empty($property)) {
            throw new InvalidArgumentException('Filter property cannot be empty.');
        }

        $this->property = $property;
    }


    /**
     * @param string $value
     */
    private function setValue($value)
    {
        if (empty($value)) {
            throw new InvalidArgumentException('Filter value cannot be empty.');
        }

        $this->value = $value;
    }


    /**
     * @param string $type
     */
    private function setType($type)
    {
        if (! in_array($type, $this->validTypes)) {
            throw new InvalidArgumentException("Filter type '$type' is not supported.");
        }

        $this->type = $type;
    }


    /**
     * @param string $value
     */
    private function parseValue($value)
    {
        if ($this->isJoin($value)) {
            $this->handleJoin($value);
        } elseif ($this->isValueTypePair($value)) {
            $this->handleValueTypePair($value);
        } elseif ($this->isBetween($value)) {
            $this->handleBetween($value);
        } elseif ($this->isValue($value)) {
            $this->handleValue($value);
        } else {
            throw new InvalidArgumentException('Filter value is malformed.');
        }
    }


    /**
     * @param string $value
     */
    private function handleJoin($value)
    {
        $this->setValue($value);
        $this->setType(self::TYPE_JOIN);
    }


    /**
     * @param $value
     */
    private function handleValueTypePair($value)
    {
        list ($value, $type) = explode(':', $value);

        $this->setValue($value);
        $this->setType($type);
    }


    /**
     * @param string $value
     */
    private function handleBetween($value)
    {
        $this->setValue($value);
        $this->setType(self::TYPE_BETWEEN);
    }


    /**
     * @param string $value
     */
    private function handleValue($value)
    {
        $this->setValue($value);
        $this->setType(self::TYPE_EQUALS);
    }


    /**
     * @param string $value
     *
     * @return bool
     */
    private function isJoin($value)
    {
        return is_object($value);
    }


    /**
     * @param string $value
     *
     * @return bool
     */
    private function isValueTypePair($value)
    {
        return is_string($value) && strpos($value, ':') !== false;
    }


    /**
     * @param string $value
     *
     * @return bool
     */
    private function isBetween($value)
    {
        return is_string($value) && strpos($value, ',') !== false;
    }


    /**
     * @param string $value
     *
     * @return bool
     */
    private function isValue($value)
    {
        return is_string($value);
    }
}
