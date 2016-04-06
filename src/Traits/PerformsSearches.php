<?php

namespace Nord\Lumen\Core\Traits;

use Nord\Lumen\Elasticsearch\Contracts\ElasticsearchService;

trait PerformsSearches
{
    /**
     * @param array $params
     *
     * @return array
     */
    private function performSearch(array $params = [])
    {
        return $this->getElasticsearchService()->search($params);
    }

    /**
     * @return ElasticsearchService
     */
    private function getElasticsearchService()
    {
        return app(ElasticsearchService::class);
    }
}
