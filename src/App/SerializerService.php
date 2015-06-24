<?php namespace Nord\Lumen\Core\App;

use Crisu83\Overseer\Entity\Resource as RbacResource;
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
     *
     * @return mixed
     */
    public function serialize($data, array $params = [])
    {
        return $this->isArray($data) ? $this->serializeArray($data, $params) : $this->serializeItem($data, $params);
    }


    /**
     * @param mixed $data
     * @param array $params
     *
     * @return array
     */
    protected function serializeArray($data, array $params)
    {
        $array = [];

        foreach ($data as $item) {
            $array[] = $this->serializeItem($item, $params);
        }

        return $array;
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
     * @param mixed $item
     * @param array $params
     *
     * @return array
     */
    protected function serializeItem($item, array $params)
    {
        $array = $this->serializer->toArray($item);

        if ($item instanceof RbacResource && !empty($params)) {
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
