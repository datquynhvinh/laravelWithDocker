<?php
namespace App\Repositories;

interface RepositoryInterface {
    public function getAll();

    public function findById($id);

    public function create($attribute = []);

    public function update($id, $attribute = []);

    public function delete($id);
}
