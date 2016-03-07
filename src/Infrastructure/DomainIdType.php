<?php namespace Nord\Lumen\Core\Infrastructure;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;
use Nord\Lumen\Core\Domain\DomainId;

final class DomainIdType extends Type
{

    /**
     * @inheritdoc
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value instanceof DomainId ? $value->getValue() : $value;
    }


    /**
     * @inheritdoc
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return new DomainId($value);
    }


    /**
     * @inheritdoc
     */
    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return $platform->getVarcharTypeDeclarationSQL($fieldDeclaration);
    }


    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'domain_id';
    }
}
