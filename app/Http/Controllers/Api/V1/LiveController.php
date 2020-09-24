<?php

namespace App\Http\Controllers\Api\V1;

use App\Commons\Helpers\ServiceHelper;
use App\Http\Controllers\Controller;
use App\Commons\Helpers\ResponseHelper;
use Illuminate\Http\Request;

class LiveController extends Controller
{
    /**
     * @return ResponseHelper
     */
    public function list() : ResponseHelper
    {
        return ServiceHelper::make('Api\\V1\\LiveService')->list();
    }

    public function store()
    {
        return ServiceHelper::make('Api\\V1\\LiveService')->store();
    }

    public function show()
    {
        return ServiceHelper::make('Api\\V1\\LiveService')->show();
    }

    public function destroy()
    {
        return ServiceHelper::make('Api\\V1\\LiveService')->destroy();
    }
}
