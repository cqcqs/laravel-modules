<?php
namespace App\Commons\Contracts;

interface RepositoryInterface
{
    public function all(array $columns=['*']);

    public function paginate(int $perPage = 20, array $columns=['*']);

    public function create(array $data);

    public function update(array $data, int $id);

    public function delete(int $id);

    public function find(int $id, array $columns=['*']);

    public function findBy(string $attribute, $value, array $columns=['*']);

}
