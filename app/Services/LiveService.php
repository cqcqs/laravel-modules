<?php
namespace App\Services;

use App\Commons\Helpers\ResponseHelper;
use App\Commons\Kernels\Service;

class LiveService extends Service
{
    public function store()
    {
        $response = new ResponseHelper();
        return $response;
    }
}