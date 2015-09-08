<?php namespace Nord\Lumen\Core\App;

use Closure;
use Crisu83\Overseer\Entity\Resource;
use Nord\Lumen\Rbac\Contracts\RbacService;

trait ChecksPermissions
{

    /**
     * @var RbacService
     */
    private $rbacService;


    /**
     * @param string        $permissionName
     * @param Resource|null $resource
     * @param array         $params
     *
     * @return bool
     */
    private function hasPermission($permissionName, Resource $resource = null, array $params = [])
    {
        return $this->rbacService->hasPermissions($permissionName, $resource, $params);
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
        if (!$this->hasPermission($permissionName, $resource, $params)) {
            call_user_func($notAllowed);
        }

        return true;
    }


    /**
     * @return RbacService
     */
    private function getRbacService()
    {
        return $this->rbacService;
    }


    /**
     * @param RbacService $rbacService
     */
    private function setRbacService($rbacService)
    {
        $this->rbacService = $rbacService;
    }
}
