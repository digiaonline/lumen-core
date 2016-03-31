<?php

namespace Nord\Lumen\Core\Traits;

use Closure;
use Nord\Lumen\Core\Domain\DomainId;
use Nord\Lumen\Core\Exceptions\FatalError;

trait CreatesIdentities
{
    /**
     * @param Closure $objectIdExists
     *
     * @return DomainId
     * @throws FatalError
     */
    private function createDomainId(Closure $objectIdExists)
    {
        $numTries = 0;

        do {
            $domainId = new DomainId();

            if ($numTries++ >= 10) {
                throw new FatalError('Failed to generate a unique identifier.');
            }
        } while (call_user_func($objectIdExists, $domainId->getValue()));

        return $domainId;
    }
}
