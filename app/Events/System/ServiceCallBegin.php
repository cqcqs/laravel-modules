<?php
namespace App\Events\System;

class ServiceCallBegin
{
    /**
     * @var string
     */
    private $service;

    /**
     * @var string
     */
    private $method;

    /**
     * ServiceCallBegin constructor.
     * @param $service
     * @param $method
     */
    public function __construct($service, $method)
    {
        $this->service = $service;
        $this->method = $method;
    }

    /**
     * @return string
     */
    public function getService(): string
    {
        return $this->service;
    }

    /**
     * @param string $service
     */
    public function setService(string $service): void
    {
        $this->service = $service;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @param string $method
     */
    public function setMethod(string $method): void
    {
        $this->method = $method;
    }


}