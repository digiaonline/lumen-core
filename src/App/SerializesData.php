<?php namespace Nord\Lumen\Core\App;

trait SerializesData
{

    /**
     * @var SerializerService
     */
    private $serializerService;


    /**
     * @param mixed $data
     *
     * @return mixed
     */
    private function serialize($data)
    {
        return $this->serializerService->serialize($data);
    }


    /**
     * @param mixed $data
     * @param array $params
     *
     * @return mixed
     */
    private function serializeWithPermissions($data, array $params = [])
    {
        return $this->serializerService->serializeWithPermissions($data, $params);
    }


    /**
     * @return SerializerService
     */
    public function getSerializerService()
    {
        return $this->serializerService;
    }


    /**
     * @param SerializerService $serializerService
     */
    private function setSerializerService($serializerService)
    {
        $this->serializerService = $serializerService;
    }
}
