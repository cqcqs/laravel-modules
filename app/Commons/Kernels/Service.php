<?php
namespace App\Commons\Kernels;

abstract class Service
{
    private $assignAction;

    /**
     * 这个其实是个占位符
     * @param $context
     * @return static
     * @see ServiceHelper::ctx()
     */
    public function ctx(/** @noinspection PhpUnusedParameterInspection */ $context)
    {
        return $this;
    }

    public function setAssignAction($value)
    {
        $this->assignAction = $value;
    }
}