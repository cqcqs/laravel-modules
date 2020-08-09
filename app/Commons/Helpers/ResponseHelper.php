<?php
namespace App\Commons\Helpers;

use JsonSerializable;

class ResponseHelper implements JsonSerializable
{
    /**
     * @var int
     */
    private $code = 200;

    /**
     * @var string
     */
    private $msg;

    /**
     * @var array
     */
    private $data;

    /**
     * @var array
     */
    private $meta;

    public function jsonSerialize()
    {
        return $this->toArray();
    }

    /**
     * @return array
     */
    public function toArray() : array
    {
        $newArray = [];

        $newArray['code'] = $this->code;
        $newArray['msg'] = $this->msg ?? '';

        $this->data && $newArray['data'] = $this->data;
        $this->meta && $newArray['meta'] = $this->meta;

        return $newArray;
    }

    /**
     * @return int
     */
    public function getCode(): int
    {
        return $this->code;
    }

    /**
     * @param int $code
     */
    public function setCode(int $code): void
    {
        $this->code = $code;
    }

    /**
     * @return string
     */
    public function getMsg(): string
    {
        return $this->msg;
    }

    /**
     * @param string $msg
     */
    public function setMsg(string $msg): void
    {
        $this->msg = $msg;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @param array $data
     */
    public function setData(array $data): void
    {
        $this->data = $data;
    }

    /**
     * @return array
     */
    public function getMeta(): array
    {
        return $this->meta;
    }

    /**
     * @param array $meta
     */
    public function setMeta(array $meta): void
    {
        $this->meta = $meta;
    }


}