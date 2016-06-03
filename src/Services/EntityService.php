<?php

namespace Nord\Lumen\Core\Services;

use Nord\Lumen\Core\Infrastructure\EntityRepository;
use Nord\Lumen\Core\Traits\ManagesEntities;

abstract class EntityService
{
    use ManagesEntities;

    /**
     * @return EntityRepository
     */
    abstract protected function getRepository();
}
