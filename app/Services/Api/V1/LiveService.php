<?php
namespace App\Services\Api\V1;

use App\Commons\Helpers\ResponseHelper;
use App\Commons\Kernels\Service;
use App\DTO\CommonDTO;
use App\PO\FieldsPO;
use App\PO\FindRowPO;
use App\PO\GetListPO;
use App\PO\LiveFieldsPO;
use App\Repositories\LiveRepository;

class LiveService extends Service
{
    protected $live;

    public function __construct(LiveRepository $live)
    {
        $this->live = $live;
    }

    /**
     * @return ResponseHelper
     */
    public function list() : ResponseHelper
    {
        $listPO = new GetListPO();
        $listPO->setLoadCollection(true);
        $listPO->setWhere([
            ['subject', 'like', '%95092%']
        ]);
        $listPO->setWhereIn(['status', [2,3]]);
        $list = $this->live->all($listPO);

        $response = new ResponseHelper();
        $response->setData($list->toArray());
        return $response;
    }

    public function store()
    {
        $data = [
            'subject' => '测试标题' . rand(10001, 99999),
            'status' => 1
        ];
        $fields = new LiveFieldsPO($data);
        $liveId = $this->live->insert($fields);

        $response = new ResponseHelper();
        $response->setData(['id' => $liveId]);
        return $response;
    }

    public function show()
    {
        $findRowPO = new FindRowPO();
        $findRowPO->setId(2);
        $data = $this->live->find($findRowPO);

        $response = new ResponseHelper();
        $response->setData($data->toArray());
        return $response;
    }

    public function destroy()
    {
        $findRowPO = new FindRowPO();
        $findRowPO->setId(2);
        $this->live->delete($findRowPO);

        return new ResponseHelper();
    }
}
