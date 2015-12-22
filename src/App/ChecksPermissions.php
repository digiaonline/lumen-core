<?php namespace Nord\Lumen\Core\App;

use Closure;
use Crisu83\Overseer\Entity\Assignment;
use Crisu83\Overseer\Entity\Resource;
use Crisu83\Overseer\Entity\Subject;
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
     * @param Subject       $subject
     * @param Resource|null $resource
     * @param array         $params
     *
     * @return mixed
     */
    private function subjectHasPermission(
        $permissionName,
        Subject $subject,
        Resource $resource = null,
        array $params = []
    ) {
        return $this->getRbacService()->subjectHasPermissions($permissionName, $subject, $resource, $params);
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
     * @param Subject $subject
     * @param array   $roles
     *
     * @return Assignment
     */
    private function createRbacAssignment(Subject $subject, array $roles = [])
    {
        return $this->getRbacService()->createAssignment($subject, $roles);
    }


    /**
     * @param Subject $subject
     * @param array   $roles
     *
     * @return Assignment
     */
    private function updateRbacAssignment(Subject $subject, array $roles)
    {
        return $this->getRbacService()->updateAssignment($subject, $roles);
    }


    /**
     * @return RbacService
     */
    private function getRbacService()
    {
        return app(RbacService::class);
    }
}
