<?php
namespace App\DTO\Base;

trait SubsetFieldsDTOTrait
{
    /**
     * @var string[] | null
     */
    protected $fields;

    /**
     * @return string[]|null
     */
    public function getFields(): ?array
    {
        return $this->fields;
    }

    /**
     * @param mixed|null $fields
     */
    public function setFields($fields): void
    {
        if (!$fields) {
            $this->fields = null;
            return;
        }

        if (is_array($fields)) {
            $this->fields = $fields;
            return;
        }

        $fields = explode(',', $fields);
        if (!count($fields)) {
            $this->fields = [];
            return;
        }

        $this->fields = $fields;
    }

    /**
     * @param string $field
     * @return bool
     */
    public function hasField(string $field) : bool
    {
        return is_null($this->fields) || in_array($field, $this->fields);
    }


}
