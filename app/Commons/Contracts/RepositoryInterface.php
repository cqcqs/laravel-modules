<?php
namespace App\Commons\Contracts;

use App\PO\FieldsPO;
use App\PO\FindRowPO;
use App\PO\GetListPO;

interface RepositoryInterface
{
    /**
     * @param GetListPO $getListPO
     * @return mixed
     */
    public function all(GetListPO $getListPO);

    /**
     * @param GetListPO $getListPO
     * @return mixed
     */
    public function paginate(GetListPO $getListPO);

    /**
     * @param FieldsPO $fieldsPO
     * @return mixed
     */
    public function insert(FieldsPO $fieldsPO);

    /**
     * @param FieldsPO $fieldsPO
     * @return mixed
     */
    public function update(FieldsPO $fieldsPO);

    /**
     * @param FindRowPO $findRowPO
     * @return mixed
     */
    public function delete(FindRowPO $findRowPO);

    /**
     * @param FindRowPO $findRowPO
     * @return mixed
     */
    public function find(FindRowPO $findRowPO);

}
