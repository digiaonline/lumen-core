<?php

namespace Nord\Lumen\Core\Traits;

use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Collections\Selectable;
use Doctrine\ORM\QueryBuilder;
use League\Fractal\Pagination\PagerfantaPaginatorAdapter;
use Pagerfanta\Adapter\AdapterInterface;
use Pagerfanta\Adapter\ArrayAdapter;
use Pagerfanta\Adapter\DoctrineCollectionAdapter;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Adapter\DoctrineSelectableAdapter;
use Pagerfanta\Exception\NotValidCurrentPageException;
use Pagerfanta\Pagerfanta;

trait PaginatesData
{
    /**
     * @param array $array
     * @param int   $page
     * @param int   $count
     *
     * @return PagerfantaPaginatorAdapter
     */
    private function createArrayPaginator(array $array, $page, $count)
    {
        return $this->createPaginator(new ArrayAdapter($array), $page, $count);
    }

    /**
     * @param QueryBuilder $queryBuilder
     * @param int          $page
     * @param int          $count
     *
     * @return PagerfantaPaginatorAdapter
     */
    private function createQueryBuilderPaginator(QueryBuilder $queryBuilder, $page, $count)
    {
        return $this->createPaginator(new DoctrineORMAdapter($queryBuilder), $page, $count);
    }

    /**
     * @param Collection $collection
     * @param int        $page
     * @param int        $count
     *
     * @return PagerfantaPaginatorAdapter
     */
    private function createCollectionPaginator(Collection $collection, $page, $count)
    {
        return $this->createPaginator(new DoctrineCollectionAdapter($collection), $page, $count);
    }

    /**
     * @param Selectable $selectable
     * @param Criteria   $criteria
     * @param int        $page
     * @param int        $count
     *
     * @return PagerfantaPaginatorAdapter
     */
    private function createSelectablePaginator(Selectable $selectable, Criteria $criteria, $page, $count)
    {
        return $this->createPaginator(new DoctrineSelectableAdapter($selectable, $criteria), $page, $count);
    }

    /**
     * @param AdapterInterface $adapter
     * @param int              $page
     * @param int              $count
     *
     * @return PagerfantaPaginatorAdapter
     */
    private function createPaginator(AdapterInterface $adapter, $page, $count)
    {
        $pager = new Pagerfanta($adapter);

        try {
            $pager->setMaxPerPage($count)->setCurrentPage($page);
        } catch (NotValidCurrentPageException $e) {
            // Do nothing, because we don't care ...
        }

        return new PagerfantaPaginatorAdapter($pager, function ($page) {
            return "page={$page}";
        });
    }
}
