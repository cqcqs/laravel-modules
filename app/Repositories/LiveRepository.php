<?php
namespace App\Repositories;

use App\Commons\Kernels\Repository;
use App\Models\Live;

class LiveRepository extends Repository
{
    public function model()
    {
        return Live::class;
    }

}
