<?php

namespace App\Http\Controllers\Api\V1;

use App\Commons\Helpers\ServiceHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\LiveStoreRequest;
use Illuminate\Http\Request;

class LiveController extends Controller
{
    public function store(LiveStoreRequest $request)
    {
        return ServiceHelper::make('LiveService')->store();
    }
}
