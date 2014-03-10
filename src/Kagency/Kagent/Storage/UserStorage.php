<?php

namespace Kagency\Kagent\Storage;

use Kagency\Kagent\User;

/**
 * Class: UserStorage
 *
 * Stores user related data
 *
 * @version $Revision$
 */
abstract class UserStorage
{
    /**
     * Get all users
     *
     * @return User[]
     */
    abstract public function getUsers();

    /**
     * Find user by name
     *
     * @param string $name
     * @return User
     */
    abstract public function find($name);

    /**
     * Save user
     *
     * @param User $user
     * @return void
     */
    abstract public function save(User $user);

    /**
     * Disable user
     *
     * @param User $user
     * @return void
     */
    abstract public function disable(User $user);
}
