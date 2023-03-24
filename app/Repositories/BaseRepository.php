<?php
namespace App\Repositories;

use App\Repositories\RepositoryInterface;

abstract class BaseRepository implements RepositoryInterface {
    protected $model;

    public function __construct()
    {
        $this->setModel();
    }

    public function setModel()
    {
        $this->model = app()->make($this->getModel());
    }

    abstract public function getModel();

    public function getAll() {
        return $this->model->all();
    }

    public function findById($id) {
        return $this->model->find($id);
    }

    public function create($attribute = []) {
        return $this->model->create($attribute);
    }

    public function update($id, $attribute = []) {
        $result = $this->model->find($id);
        if ($result) {
            return $result->update($attribute);
        }

        return false;
    }

    public function delete($id) {
        $result = $this->model->find($id);
        if ($result) {
            return $result->delete();
        }

        return false;
    }
}
