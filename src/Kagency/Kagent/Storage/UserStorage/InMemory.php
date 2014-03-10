<?php

namespace Kagency\Kagent\Storage\UserStorage;

use Kagency\Kagent\Storage\UserStorage;
use Kagency\Kagent\User;

class InMemory extends UserStorage
{
    /**
     * Users
     *
     * @var User[]
     */
    private $users = array();

    /**
     * Get all users
     *
     * @return User[]
     */
    public function getUsers()
    {
        return array_values($this->users);
    }

    /**
     * Find user by name
     *
     * @param string $name
     * @return User
     */
    public function find($name)
    {
        if (!isset($this->users[$name])) {
            throw new \OutOfBoundsException("No user with name $name available.");
        }

        return $this->users[$name];
    }

    /**
     * Save user
     *
     * @param User $user
     * @return void
     */
    public function save(User $user)
    {
        $this->users[$user->name] = $user;
    }

    /**
     * Disable user
     *
     * @param User $user
     * @return void
     */
    public function disable(User $user)
    {
        unset($this->users[$user->name]);
    }
}
