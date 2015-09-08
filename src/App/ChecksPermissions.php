<?php namespace Nord\Lumen\Core\App;

use Closure;
use Crisu83\Overseer\Entity\Resource;
use Nord\Lumen\Rbac\Contracts\RbacService;

trait ChecksPermissions
{


    /**
     * @param string        $permissionName
     * @param Resource|null $resource
     * @param array         $params
     *
     * @return bool
     */
    private function hasPermission($permissionName, Resource $resource = null, array $params = [])
    {
        return $this->getRbacService()->hasPermissions($permissionName, $resource, $params);
    }


    /**
     * @param string        $permissionName
     * @param Closure       $notAllowed
     * @param Resource|null $resource
     * @param array         $params
     *
     * @return bool
     */
    private function tryHasPermission(
        $permissionName,
        Closure $notAllowed,
        Resource $resource = null,
        array $params = []
    ) {
        if (!($result = $this->hasPermission($permissionName, $resource, $params))) {
            call_user_func($notAllowed);
        }

        return $result;
    }


    /**
     * @return RbacService
     */
    private function getRbacService()
    {
        return app(RbacService::class);
    }
}
