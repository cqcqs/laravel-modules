<?php
namespace App\Commons\Kernels;

use App\Commons\Contracts\RepositoryInterface;
use App\PO\FieldsPO;
use App\PO\FindRowPO;
use App\PO\GetListPO;
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
     * @param GetListPO $getListPO
     * @return LengthAwarePaginator|Builder[]|Collection|mixed
     */
    public function all(GetListPO $getListPO)
    {
        // condition where
        $getListPO->getWhere() && $this->model->where($getListPO->getWhere());

        // condition whereIn
        $getListPO->getWhereIn() && $this->model->whereIn($getListPO->getWhereIn()[0], $getListPO->getWhereIn()[1]);

        // condition whereNotIn
        $getListPO->getWhereNotIn() && $this->model->whereNotIn($getListPO->getWhereNotIn()[0], $getListPO->getWhereNotIn()[1]);

        // order by
        if ($orderBy = $getListPO->getOrderBy()) {
            foreach ($orderBy as $order) {
                $this->model->orderBy($order[0], $order[1] ?? 'asc');
            }
        }

        // load collection or pagination
        if (!$getListPO->isLoadCollection()) {
            return $this->paginate($getListPO, $this->model);
        }

        return $this->model->get($getListPO->getFields() ?? ['*']);
    }

    /**
     * 分页查询
     * @param GetListPO $getListPO
     * @param null $model
     * @return LengthAwarePaginator
     */
    public function paginate(GetListPO $getListPO, $model = null)
    {
        if (!$model) {
            $model = $this->model;
        }
        return $model->paginate(
            $getListPO->getLimit(),
            $getListPO->getFields() ?? '*',
            null,
            $getListPO->getPage()
        );
    }

    /**
     * 插入数据
     * @param FieldsPO $fieldsPO
     * @return int
     */
    public function insert(FieldsPO $fieldsPO)
    {
        return $this->model->insertGetId($fieldsPO->toArray());
    }

    /**
     * 修改数据（根据主键ID）
     * @param FieldsPO $fieldsPO
     * @return bool|int
     */
    public function update(FieldsPO $fieldsPO)
    {
        return $this->model->find($fieldsPO->getId())->update($fieldsPO->toArray());
    }

    /**
     * 删除数据（根据主键ID）
     * @param FindRowPO $findRowPO
     * @return bool|mixed|null
     * @throws Exception
     */
    public function delete(FindRowPO $findRowPO)
    {
        return $this->model->find($findRowPO->getId())->delete();
    }

    /**
     * 查询一条数据
     * @param FindRowPO $findRowPO
     * @return Builder|Builder[]|Collection|Model|null
     */
    public function find(FindRowPO $findRowPO)
    {
        return $this->model->find(
            $findRowPO->getId(),
            $findRowPO->getFields() ?? ['*']
        );
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
