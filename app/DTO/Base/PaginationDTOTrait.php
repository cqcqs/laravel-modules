<?php
namespace App\DTO\Base;

trait PaginationDTOTrait
{
    /**
     * @var int|null
     */
    protected $page_size;

    /**
     * @var int|null
     */
    protected $page;

    /**
     * @var int|null
     */
    protected $offset;

    /**
     * @var int|null
     */
    protected $limit;

    /**
     * @var bool|null
     */
    protected $load_collection;

    /**
     * @return int|null
     */
    public function getPageSize(): ?int
    {
        return $this->page_size;
    }

    /**
     * @param int|null $page_size
     */
    public function setPageSize(?int $page_size): void
    {
        $this->page_size = $page_size;
    }

    /**
     * @return int|null
     */
    public function getPage(): ?int
    {
        return $this->page;
    }

    /**
     * @param int|null $page
     */
    public function setPage(?int $page): void
    {
        $this->page = $page;
    }

    /**
     * @return int|null
     */
    public function getOffset(): ?int
    {
        return $this->offset;
    }

    /**
     * @param int|null $offset
     */
    public function setOffset(?int $offset): void
    {
        $this->offset = $offset;
    }

    /**
     * @return int|null
     */
    public function getLimit(): ?int
    {
        return $this->limit;
    }

    /**
     * @param int|null $limit
     */
    public function setLimit(?int $limit): void
    {
        $this->limit = $limit;
    }

    /**
     * @return bool|null
     */
    public function getLoadCollection(): ?bool
    {
        return $this->load_collection;
    }

    /**
     * @param bool|null $load_collection
     */
    public function setLoadCollection(?bool $load_collection): void
    {
        $this->load_collection = $load_collection;
    }


}
