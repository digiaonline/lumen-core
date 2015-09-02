<?php namespace Nord\Lumen\Core\Domain\Model;

use Eventello\Access\Domain\Model\User;

abstract class EntityEvent extends DomainEvent
{

    /**
     * @var User
     */
    private $user;


    /**
     * EntityEvent constructor.
     *
     * @param string $channel
     * @param string $name
     * @param User   $user
     */
    public function __construct($channel, $name, User $user)
    {
        parent::__construct($channel, $name);

        $this->setUser($user);
    }


    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }


    /**
     * @param User $user
     */
    private function setUser(User $user)
    {
        $this->user = $user;
    }
}
