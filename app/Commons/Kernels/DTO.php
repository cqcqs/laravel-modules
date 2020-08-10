<?php
namespace App\Commons\Kernels;

use App\Commons\Helpers\StringHelper;
use ReflectionClass;

abstract class DTO
{

    protected $hidden = ['hidden'];

    public function __construct(array $attributes = [], bool $strict = false)
    {
        $this->fill($attributes);
    }

    /**
     * @return array
     */
    public function toArray() : array
    {
        try {
            $array = [];
            $reflection = new ReflectionClass($this);
            $properties = $reflection->getProperties();
            foreach ($properties as $property) {
                if (in_array($property->getName(), $this->hidden)) {
                    continue;
                }

                $method = StringHelper::camelConvert('get_' . $property->getName());
                $method = $reflection->hasMethod($method) ? $method : StringHelper::camelConvert('is' . $property->getName());
                $method = $reflection->hasMethod($method) ? $method : StringHelper::camelConvert($property->getName());

                $propVal = $this->{$method}();
                $propType = gettype($propVal);
                $propVal = in_array($propType, ['object'])
                    ? (method_exists($propVal, 'toArray') ? $propVal->toArray() : $propVal)
                    : $propVal;
                $propVal = in_array($propType, ['array'])
                    ? array_map(function ($item) {
                        return in_array(gettype($item), ['object'])
                            ? (method_exists($item, 'toArray') ? $item->toArray() : $item)
                            : $item;
                    }, $propVal)
                    : $propVal;

                $array[$property->getName()] = $propVal;
            }
            return $array;
        } catch (\ReflectionException $exception) {

        }

        return [];
    }

    /**
     * @param array $attributes
     */
    private function fill(array $attributes)
    {
        /*collect($attributes)->each(function ($attribute, $key){
            $method = StringHelper::camelConvert('set_' . $key);
            if (property_exists($this, $key) && method_exists($this, $method)) {
                $this->{$method}($attribute);
            }
        });*/

        try {
            $reflection = new ReflectionClass($this);
            $properties = $reflection->getProperties();
            foreach ($properties as $property) {
                if (in_array($property->getName(), $this->hidden)) {
                    continue;
                }

                $method = StringHelper::camelConvert('set_' . $property->getName());
                $value = data_get($attributes, $property->getName());
                if ($reflection->hasMethod($method) && $value !== null) {
                    $this->{$method}($value);
                }
            }
        } catch (\ReflectionException $exception) {

        }
    }

}
