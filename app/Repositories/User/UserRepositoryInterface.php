<?php
namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\RepositoryInterface;

interface UserRepositoryInterface extends RepositoryInterface {
    /**
     * @return \App\Models\User[]
     */
    public function getUsers();

    /**
     * @return \App\Models\User[]
     */
    public function getFollowUsers();
}
