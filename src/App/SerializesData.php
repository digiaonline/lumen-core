<?php namespace Nord\Lumen\Core\App;

trait SerializesData
{

    /**
     * @param mixed $data
     *
     * @return mixed
     */
    private function serializeData($data)
    {
        return $this->getSerializerService()->serialize($data);
    }


    /**
     * @param mixed $data
     * @param array $params
     *
     * @return mixed
     */
    private function serializeWithPermissions($data, array $params = [])
    {
        return $this->getSerializerService()->serializeWithPermissions($data, $params);
    }


    /**
     * @return SerializerService
     */
    public function getSerializerService()
    {
        return app(SerializerService::class);
    }
}
