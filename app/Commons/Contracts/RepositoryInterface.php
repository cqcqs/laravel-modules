<?php
namespace App\Common\Contracts;

interface RepositoryInterface
{
    public function all(array $fields=['*']);

    public function paginate(int $perPage = 20, array $fields=['*']);

    public function store(array $data);

    public function update(array $data, int $id);

    public function delete(int $id);

    public function find(int $id, array $fields=['*']);

    public function findBy(string $field, $value, array $fields=['*']);

}
