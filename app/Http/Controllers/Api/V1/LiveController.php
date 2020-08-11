<?php

namespace App\Http\Controllers\Api\V1;

use App\Commons\Helpers\ServiceHelper;
use App\DTO\CommonDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LiveListRequest;
use App\Commons\Helpers\ResponseHelper;

class LiveController extends Controller
{
    /**
     * @param LiveListRequest $request
     * @return ResponseHelper
     */
    public function list(LiveListRequest $request) : ResponseHelper
    {
        $commonDTO = new CommonDTO([
            'id' => $request->post('id')
        ]);

        return ServiceHelper::make('Api\\V1\\LiveService')->list($commonDTO);
    }
}
