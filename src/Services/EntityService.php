<?php

namespace App\Access\Services;

use Doctrine\ORM\QueryBuilder;
use League\Fractal\Pagination\PagerfantaPaginatorAdapter;
use League\Fractal\Pagination\PaginatorInterface;
use Nord\Lumen\Core\Infrastructure\EntityRepository;
use Nord\Lumen\Core\Traits\ManagesEntities;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Exception\NotValidCurrentPageException;
use Pagerfanta\Pagerfanta;

abstract class EntityService
{
    use ManagesEntities;

    /**
     * @return EntityRepository
     */
    abstract protected function getRepository();

    /**
     *
     * @param QueryBuilder $queryBuilder
     * @param int          $page
     * @param int          $count
     *
     * @return PaginatorInterface
     */
    protected function createPaginatorWithQueryBuilder(QueryBuilder $queryBuilder, $page, $count)
    {
        $pager = new Pagerfanta(new DoctrineORMAdapter($queryBuilder));

        try {
            $pager->setMaxPerPage($count)->setCurrentPage($page);
        } catch (NotValidCurrentPageException $e) {
            // Do nothing, because we don't care ...
        }

        return new PagerfantaPaginatorAdapter($pager, null);
    }
}