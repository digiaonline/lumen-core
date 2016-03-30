<?php

namespace Nord\Lumen\Core\Traits;

use League\Fractal\TransformerAbstract;
use Nord\Lumen\Fractal\Contracts\FractalBuilder;
use Nord\Lumen\Fractal\Contracts\FractalService;

trait SerializesData
{

    /**
     * @param mixed                    $item
     * @param TransformerAbstract|null $transformer
     * @param string                   $resourceKey
     *
     * @return FractalBuilder
     */
    public function serializeItem($item, TransformerAbstract $transformer = null, $resourceKey = null)
    {
        return $this->getFractalService()
            ->item($item, $transformer, $resourceKey);
    }


    /**
     * @param mixed                    $collection
     * @param TransformerAbstract|null $transformer
     * @param string                   $resourceKey
     *
     * @return FractalBuilder
     */
    public function serializeCollection($collection, TransformerAbstract $transformer = null, $resourceKey = null)
    {
        return $this->getFractalService()
            ->collection($collection, $transformer, $resourceKey);
    }


    /**
     * @return FractalService
     */
    public function getFractalService()
    {
        return app(FractalService::class);
    }
}
