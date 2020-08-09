<?php
namespace App\Commons\Helpers;

use App\Commons\Kernels\Service;
use App\Events\System\ServiceCallBegin;
use App\Events\System\ServiceCallEnd;
use App\Events\SystemAsyncEvent;
use Illuminate\Support\Str;
use BadMethodCallException;

class ServiceHelper
{
    protected $service;

    public $action;
    public $type;
    public $async;

    private static $callStacks = [];

    /**
     * ServiceHelper constructor.
     * @param string $service
     * @deprecated use ServiceHelper::make() instead
     */
    public function __construct(string $service)
    {
        if (Str::startsWith($service, 'Modules')) {
            $this->service = $service;
        } else {
            $this->service = 'App\Services\\' . $service;
        }
    }

    /**
     * @param string $service
     * @return ServiceHelper
     */
    public static function make(string $service)
    {
        return new self($service);
    }

    public static function getCallStacks()
    {
        return self::$callStacks;
    }

    /**
     * 是否是内部调用
     *
     * 判断依据是一个 Service 中的代码当前位置是否是从另外一个 Service 中发起的
     * Service 的调用必须使用 ServiceHelper 做代理，这种判断才是准确的
     *
     * @return bool
     */
    public static function isInternalCall()
    {
        return count(self::$callStacks) > 1;
    }

    public function ctx(array $context)
    {
        $helper = clone $this;
        $helper->type = data_get($context, 'type');
        $helper->action = data_get($context, 'action');
        $helper->async = data_get($context, 'async');

        return $helper;
    }

    /**
     * Description: Call Method With Param
     *
     * @param $method
     * @param null $data
     * @param string $type
     * @param null $path
     * @return mixed
     */
    public function call($method, $data = null, $type = 'get', $path = null)
    {
        $ob = app($this->service);
        if ($ob instanceof Service) {
            $ob->setAssignAction($path);
        }

        if (count(self::$callStacks) === 0) {
            event(new ServiceCallBegin($this->service, $method));
        }

        array_push(self::$callStacks, "{$this->service}::{$method}");

        try {
            $res = $ob->$method($data);
        } finally {
            array_pop(self::$callStacks);
        }

        if (count(self::$callStacks) === 0) {
            event(new ServiceCallEnd($this->service, $method));
        }

        return $res;
    }

    public function callAsync($method, $data = null, $type = 'get', $path = false)
    {
        $instance = app($this->service);
        if (!method_exists($instance, $method)) {
            throw new BadMethodCallException(__(':class 未公布方法 :method', ['class' => $this->service, 'method' => $method]));
        }

        $service = str_replace('App\Services\\', '', $this->service);
        $authId = auth()->id();
        SystemAsyncEvent::dispatch($authId, $service, $method, $data, $type, $path);

        return new ResponseHelper();
    }

    public function __call($name, $arguments)
    {
        $args = [$name, $arguments[0] ?? null, $this->type, $this->action];
        $idx = count($args);

        for ($i = count($args) - 1; $i > 0; $i--) {
            if ($args[$i] !== null) {
                break;
            }

            $idx = $i;
        }

        $args = array_slice($args, 0, $idx);

        return $this->async ? $this->callAsync(...$args) : $this->call(...$args);
    }
}