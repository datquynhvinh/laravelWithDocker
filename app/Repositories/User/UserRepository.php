<?php
namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;

class UserRepository extends BaseRepository implements UserRepositoryInterface {
    public function getModel() {
        return User::class;
    }

    /**
     * @return \App\Models\User[]
     */
    public function getUsers() {
        return $this->model->all();
    }

    /**
     * @return \App\Models\User[]
     */
    public function getFollowUsers() {
        return $this->model->where('id', '<>', Auth::user()->id)->get();
    }
}
