<?php
namespace App\Commons\Kernels;

use App\Commons\Contracts\RepositoryInterface;
use Illuminate\Container\Container as App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Exception;

abstract class Repository implements RepositoryInterface
{
    private $app;

    /**
     * @var Builder
     */
    private $model;

    /**
     * Repository constructor.
     * @param App $app
     * @throws Exception
     */
    public function __construct(App $app)
    {
        $this->app = $app;
        $this->makeModel();
    }

    /**
     * @return mixed
     */
    abstract function model();

    /**
     * @param array $columns
     * @return Builder[]|Collection
     */
    public function all(array $columns = ['*'])
    {
        return $this->model->get($columns);
    }

    /**
     * @param int $perPage
     * @param array $columns
     * @return LengthAwarePaginator
     */
    public function paginate(int $perPage = 20, array $columns = ['*'])
    {
        return $this->model->paginate($perPage, $columns);
    }

    /**
     * @param array $data
     * @return Builder|Model
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * @param array $data
     * @param int $id
     * @param string $attribute
     * @return int
     */
    public function update(array $data, int $id, $attribute="id")
    {
        return $this->model->where($attribute, '=', $id)->update($data);
    }

    /**
     * @param int $id
     * @param string $attribute
     * @return mixed
     */
    public function delete(int $id, $attribute="id")
    {
        return $this->model->where($attribute, '=', $id)->delete();
    }

    /**
     * @param int $id
     * @param array $columns
     * @return Builder|Builder[]|Collection|Model|null
     */
    public function find(int $id, array $columns = ['*'])
    {
        return $this->model->find($id, $columns);
    }

    /**
     * @param string $attribute
     * @param $value
     * @param array $columns
     * @return Builder|Model|object|null
     */
    public function findBy(string $attribute, $value, array $columns = ['*'])
    {
        return $this->model->where($attribute, '=', $value)->first($columns);
    }

    /**
     * @return Builder
     * @throws Exception
     */
    public function makeModel() : Builder
    {
        $model = $this->app->make($this->model());

        if (!$model instanceof Model) {
            throw new Exception("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }

        return $this->model = $model->newQuery();
    }
}
