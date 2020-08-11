<?php
namespace App\Commons\Helpers;

use App\Commons\Kernels\Repository;
use Illuminate\Support\Str;

class RepositoryHelper
{
    protected $repository;

    /**
     * RepositoryHelper constructor.
     * @param string $repository
     * @deprecated use RepositoryHelper::make() instead
     */
    public function __construct(string $repository)
    {
        if (Str::startsWith($repository, 'Modules')) {
            $this->repository = $repository;
        } else {
            $this->repository = 'App\Repositories\\' . $repository;
        }
    }

    /**
     * @param string $repository
     * @return RepositoryHelper
     */
    public static function make(string $repository)
    {
        return new self($repository);
    }

    public function __call($name, $arguments)
    {
        $ob = app($this->repository);
        if ($ob instanceof Repository) {

        }
    }
}
