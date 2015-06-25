<?php namespace Nord\Lumen\Core\App;

use Crisu83\Overseer\Entity\Resource as RbacResource;
use Illuminate\Contracts\Support\Arrayable;
use JMS\Serializer\Serializer;
use Nord\Lumen\Rbac\Contracts\RbacService;

class SerializerService
{

    /**
     * @var Serializer
     */
    private $serializer;

    /**
     * @var RbacService
     */
    private $rbacService;


    /**
     * SerializerService constructor.
     *
     * @param Serializer  $serializer
     * @param RbacService $rbacService
     */
    public function __construct(Serializer $serializer, RbacService $rbacService)
    {
        $this->serializer  = $serializer;
        $this->rbacService = $rbacService;
    }


    /**
     * @param mixed $data
     * @param array $params
     * @param bool  $withPermissions
     *
     * @return mixed
     */
    public function serialize($data, array $params = [], $withPermissions = false)
    {
        return $this->isArray($data)
            ? $this->serializeArray($data, $params, $withPermissions)
            : $this->serializeItem($data, $params, $withPermissions);
    }


    /**
     * @param mixed $data
     * @param array $params
     *
     * @return mixed
     */
    public function serializeWithPermissions($data, array $params = [])
    {
        return $this->serialize($data, $params, true/* withPermissions */);
    }


    /**
     * @param mixed $data
     * @param array $params
     * @param bool  $withPermissions
     *
     * @return array
     */
    protected function serializeArray($data, array $params, $withPermissions)
    {
        $array = [];

        foreach ($data as $item) {
            $array[] = $this->serializeItem($item, $params, $withPermissions);
        }

        return $array;
    }


    /**
     * @param mixed $item
     * @param array $params
     * @param bool  $withPermissions
     *
     * @return array
     */
    protected function serializeItem($item, array $params, $withPermissions)
    {
        $array = $this->serializer->toArray($item);

        if ($withPermissions && $item instanceof RbacResource) {
            $array['permissions'] = $this->rbacService->getPermissions($item, $params);
        }

        return $array;
    }


    /**
     * @param $data
     *
     * @return bool
     */
    protected function isArray($data)
    {
        return $data instanceof Arrayable || is_array($data);
    }
}
