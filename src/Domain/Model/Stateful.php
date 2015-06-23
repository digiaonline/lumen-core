<?php namespace Nord\Lumen\Core\Domain\Model;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as DTO;

trait Stateful
{

    /**
     * @DTO\Expose
     * @DTO\Type("integer")
     * @DTO\Accessor(getter="getStatusValue")
     * @DTO\ReadOnly
     *
     * @ORM\Column(type="status")
     *
     * @var Status
     */
    private $status;


    /**
     * @param Status $status
     */
    protected function setStatus(Status $status)
    {
        $this->status = $status;
    }


    /**
     * @return Status
     */
    public function getStatus()
    {
        return $this->status;
    }


    /**
     * @return int
     */
    public function getStatusValue()
    {
        return $this->status->getValue();
    }
}
