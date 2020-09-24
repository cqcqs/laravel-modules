<?php
namespace App\PO\Base;

trait ConditionsPOTrait
{
    /**
     * @var array|null
     */
    protected $where;

    /**
     * @var array|null
     */
    protected $whereIn;

    /**
     * @var array|null
     */
    protected $whereNotIn;

    /**
     * @return array|null
     */
    public function getWhere(): ?array
    {
        return $this->where;
    }

    /**
     * @param array|null $where
     */
    public function setWhere(?array $where): void
    {
        $this->where = $where;
    }

    /**
     * @return array|null
     */
    public function getWhereIn(): ?array
    {
        return $this->whereIn;
    }

    /**
     * @param array|null $whereIn
     */
    public function setWhereIn(?array $whereIn): void
    {
        $this->whereIn = $whereIn;
    }

    /**
     * @return array|null
     */
    public function getWhereNotIn(): ?array
    {
        return $this->whereNotIn;
    }

    /**
     * @param array|null $whereNotIn
     */
    public function setWhereNotIn(?array $whereNotIn): void
    {
        $this->whereNotIn = $whereNotIn;
    }


}
