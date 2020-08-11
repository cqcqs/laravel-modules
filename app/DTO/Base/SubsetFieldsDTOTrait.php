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

        $fields = collect(str_getcsv($fields))->map(function ($item){
            $item = trim($item);
            if (!$item) {
                return null;
            }
            return $item;
        })->filter(function ($item) {
            return !!$item;
        });

        if (!$fields->count()) {
            $this->fields = [];
            return;
        }

        $this->fields = $fields->toArray();
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
