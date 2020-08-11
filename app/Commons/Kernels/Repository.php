<?php
namespace App\Commons\Kernels;

use App\Common\Contracts\RepositoryInterface;
use Illuminate\Container\Container as App;

abstract class Repository implements RepositoryInterface
{
    private $app;

    private $model;

    public function __construct(App $app)
    {
        $this->app = $app;
    }

    abstract function model();

    public function makeModel()
    {
        $model = $this->app->make($this->model());

        
    }
}
