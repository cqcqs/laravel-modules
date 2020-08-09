<?php
namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SystemAsyncEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $authId;

    public $classname;

    public $method;

    public $data = null;

    public $type = 'get';

    public $path = false;

    /**
     * SystemAsyncEvent constructor.
     * @param $authId
     * @param $classname
     * @param $method
     * @param null $data
     * @param string $type
     * @param bool $path
     */
    public function __construct($authId, $classname, $method, $data, string $type, bool $path)
    {
        $this->authId = $authId;
        $this->classname = $classname;
        $this->method = $method;
        $this->data = $data;
        $this->type = $type;
        $this->path = $path;
    }


}