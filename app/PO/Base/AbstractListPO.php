<?php
namespace App\PO\Base;

use App\Commons\Kernels\PO;

abstract class AbstractListPO extends PO
{
    use ConditionsPOTrait;
    use PaginationPOTrait;
    use OrderByPOTrait;
    use SubsetFieldsPOTrait;
}
