<?php namespace Nord\Lumen\Core\App;

use Closure;
use Nord\Lumen\Core\Domain\Model\ObjectId;
use Nord\Lumen\Core\Exception\FatalError;

trait CreatesIdentities
{

    /**
     * @param Closure $objectIdExists
     *
     * @return ObjectId
     * @throws FatalError
     */
    private function createObjectId(Closure $objectIdExists)
    {
        $numTries = 0;

        do {
            $objectId = new ObjectId();

            if ($numTries++ >= 10) {
                throw new FatalError('Failed to generate unique identifier.');
            }
        } while (call_user_func($objectIdExists, $objectId->getValue()));

        return $objectId;
    }
}
