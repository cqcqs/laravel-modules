<?php
namespace App\Services\Api\V1;

use App\Commons\Helpers\ResponseHelper;
use App\Commons\Kernels\Service;
use App\DTO\CommonDTO;

class LiveService extends Service
{
    /**
     * @param CommonDTO $commonDTO
     * @return ResponseHelper
     */
    public function list(CommonDTO $commonDTO) : ResponseHelper
    {
        $response = new ResponseHelper();
        $response->setData($commonDTO->toArray());
        return $response;
    }
}
