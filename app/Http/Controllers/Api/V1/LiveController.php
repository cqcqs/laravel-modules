<?php

namespace App\Http\Controllers\Api\V1;

use App\Commons\Helpers\ServiceHelper;
use App\DTO\LiveStoreDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\LiveStoreRequest;
use Illuminate\Http\Request;

class LiveController extends Controller
{
    public function store(LiveStoreRequest $request)
    {
        $liveStoreDTO = new LiveStoreDTO([
            'subject' => $request->post('subject'),
            'page' => 3,
            'fields' => 'id, name',
            'order_by' => 'id:desc'
        ]);
dd($liveStoreDTO);
        return ServiceHelper::make('LiveService')->store($liveStoreDTO);
    }
}
