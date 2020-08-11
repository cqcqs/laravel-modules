<?php
namespace App\Commons\Helpers;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class RequestHelper
{
    /**
     * @param $dtoClass
     * @param Request|null $request
     * @return mixed
     */
    public function makeDTO($dtoClass, Request $request = null)
    {
        $request = $request ?: request();
        return new $dtoClass($request->all());
    }

    /**
     * @param $dto
     * @param FormRequest $request
     */
    public function setDTO($dto, FormRequest $request)
    {
        foreach ($request->all() as $key => $value) {
            $string = explode('_', $key);
            $method = 'set';
            foreach ($string as $item) {
                $method .= ucfirst($item);
            }

            method_exists($dto, $method) && $dto->$method($value);
        }
    }
}
