<?php namespace Nord\Lumen\Core\Infrastructure;

use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;
use Nord\Lumen\Core\Domain\Model\Entity;
use Exception;
use Nord\Lumen\Doctrine\Traits\AutoIncrements;

class EntityRepository extends \Doctrine\ORM\EntityRepository
{

    const DEFAULT_LIMIT = 20;

    /**
     * @var array
     */
    protected $filterable = [];

    /**
     * @var array
     */
    protected $sortable = [];


    /**
     * @param string $objectId
     *
     * @return Entity|null
     */
    public function findByObjectId($objectId)
    {
        return $this->findOneBy(['objectId' => $objectId]);
    }


    /**
     * @param array  $filters
     * @param string $sort
     * @param int    $offset
     * @param int    $limit
     *
     * @return Entity[]
     */
    public function query(array $filters = [], $sort = null, $offset = null, $limit = null)
    {
        $tableAlias = 't';

        $queryBuilder = $this->createQueryBuilder($tableAlias);

        $this->applyFilters($queryBuilder, $tableAlias, $filters);
        $this->applySort($queryBuilder, $tableAlias, $sort);
        $this->applyPagination($queryBuilder, $offset, $limit);

        return $queryBuilder->getQuery()->execute();
    }


    /**
     * @param QueryBuilder $queryBuilder `
     * @param string       $tableAlias
     * @param array        $filters
     *
     * @throws \Exception
     */
    protected function applyFilters(QueryBuilder $queryBuilder, $tableAlias, array $filters)
    {
        foreach ($this->normalizeFilters($filters) as $spec) {
            $property = $spec->getProperty();
            $value    = $spec->getValue();
            $type     = $spec->getType();

            if (! in_array($property, $this->filterable)) {
                throw new Exception("Property '$property' is not filterable.");
            }

            switch ($type) {
                case FilterSpec::TYPE_JOIN:
                    /** @var AutoIncrements $value */
                    $queryBuilder
                        ->innerJoin(get_class($value), $property, Join::WITH, "$property.autoIncrementId = $tableAlias.$property")
                        ->andWhere("$tableAlias.$property = :{$property}_id")
                        ->setParameter("{$property}_id", $value->getAutoIncrementId());
                    break;
                case FilterSpec::TYPE_BETWEEN:
                    list ($from, $to) = explode(',', $value);
                    $queryBuilder
                        ->andWhere("$tableAlias.$property BETWEEN :{$property}_from AND :{$property}_to")
                        ->setParameters(["{$property}_from" => $from, "{$property}_to" => $to]);
                    break;
                case FilterSpec::TYPE_NOT_EQUALS:
                    $queryBuilder->andWhere("$tableAlias.$property != :$property")->setParameter($property, "%$value%");
                    break;
                case FilterSpec::TYPE_GREATER_THAN:
                    $queryBuilder->andWhere("$tableAlias.$property > :$property")->setParameter($property, $value);
                    break;
                case FilterSpec::TYPE_LESS_THAN:
                    $queryBuilder->andWhere("$tableAlias.$property < :$property")->setParameter($property, $value);
                    break;
                case FilterSpec::TYPE_GREATER_OR_EQUAL_THAN:
                    $queryBuilder->andWhere("$tableAlias.$property >= :$property")->setParameter($property, $value);
                    break;
                case FilterSpec::TYPE_LESS_OR_EQUAL_THAN:
                    $queryBuilder->andWhere("$tableAlias.$property <= :$property")->setParameter($property, $value);
                    break;
                case FilterSpec::TYPE_FREE_TEXT:
                    $queryBuilder->andWhere("$tableAlias.$property LIKE :$property")->setParameter($property,
                        "%$value%");
                    break;
                case FilterSpec::TYPE_STARTS_WITH:
                    $queryBuilder->andWhere("$tableAlias.$property LIKE :$property")->setParameter($property,
                        "$value%");
                    break;
                case FilterSpec::TYPE_ENDS_WITH:
                    $queryBuilder->andWhere("$tableAlias.$property LIKE :$property")->setParameter($property,
                        "%$value");
                    break;
                case FilterSpec::TYPE_EQUALS:
                default:
                    $queryBuilder->andWhere("$tableAlias.$property = :$property")->setParameter($property, $value);
                    break;
            }
        }
    }


    /**
     * @param QueryBuilder $queryBuilder
     * @param string       $tableAlias
     * @param string       $sort
     *
     * @throws Exception
     */
    protected function applySort(QueryBuilder $queryBuilder, $tableAlias, $sort)
    {
        foreach ($this->normalizeSort($sort) as $spec) {
            $property = $spec->getProperty();

            if (! in_array($property, $this->sortable)) {
                throw new Exception("Property '$property' is not sortable.");
            }

            $queryBuilder->addOrderBy("$tableAlias.$property", $spec->getDirection());
        }
    }


    /**
     * @param QueryBuilder $queryBuilder
     * @param int          $offset
     * @param int          $limit
     */
    protected function applyPagination(QueryBuilder $queryBuilder, $offset = 0, $limit = self::DEFAULT_LIMIT)
    {
        $queryBuilder->setFirstResult($offset)->setMaxResults($limit);
    }


    /**
     * @param array $filters
     *
     * @return FilterSpec[]
     */
    private function normalizeFilters(array $filters)
    {
        $normalized = [];

        foreach ($filters as $property => $value) {
            if ($value === null) {
                continue;
            }

            $normalized[] = new FilterSpec($property, $value);
        }

        return $normalized;
    }


    /**
     * @param string $sort
     *
     * @return SortSpec[]
     */
    private function normalizeSort($sort)
    {
        $normalized = [];

        $sort = strpos($sort, ',') !== false ? explode(',', $sort) : [$sort];

        foreach ($sort as $value) {
            if ($value === null) {
                continue;
            }

            $normalized[] = new SortSpec($value);
        }

        return $normalized;
    }
}
