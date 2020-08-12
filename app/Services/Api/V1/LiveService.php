<?php
namespace App\Services\Api\V1;

use App\Commons\Helpers\ResponseHelper;
use App\Commons\Kernels\Service;
use App\DTO\CommonDTO;
use App\Repositories\LiveRepository;

class LiveService extends Service
{
    protected $live;

    public function __construct(LiveRepository $live)
    {
        $this->live = $live;
    }

    /**
     * @param CommonDTO $commonDTO
     * @return ResponseHelper
     */
    public function list(CommonDTO $commonDTO) : ResponseHelper
    {
        $list = $this->live->all();

        $response = new ResponseHelper();
        $response->setData($list->toArray());
        return $response;
    }
}
