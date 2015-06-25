<?php namespace Nord\Lumen\Core\Http;

use Crisu83\Overseer\Entity\Resource as RbacResource;
use Illuminate\Http\Exception\HttpResponseException;
use Nord\Lumen\Core\App\SerializerService;
use Nord\Lumen\Rbac\Contracts\RbacService;

class EntityController extends Controller
{

    /**
     * @var RbacService
     */
    private $rbacService;

    /**
     * @var SerializerService
     */
    private $serializerService;


    /**
     * EntityController constructor.
     *
     * @param RbacService       $rbacService
     * @param SerializerService $serializerService
     */
    public function __construct(RbacService $rbacService, SerializerService $serializerService)
    {
        $this->rbacService       = $rbacService;
        $this->serializerService = $serializerService;
    }


    /**
     * @param mixed $data
     *
     * @return mixed
     */
    protected function serialize($data)
    {
        return $this->serializerService->serialize($data);
    }


    /**
     * @param mixed $data
     * @param array $params
     *
     * @return mixed
     */
    protected function serializeWithPermissions($data, array $params = [])
    {
        return $this->serializerService->serializeWithPermissions($data, $params);
    }


    /**
     * @param string       $permissionName
     * @param RbacResource $resource
     * @param array        $params
     *
     * @throws HttpResponseException
     */
    protected function throwIfNotAllowed($permissionName, RbacResource $resource = null, array $params = [])
    {
        if (!$this->rbacService->hasPermissions($permissionName, $resource, $params)) {
            throw new HttpResponseException($this->forbidden());
        }
    }
}
