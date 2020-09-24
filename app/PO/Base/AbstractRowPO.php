<?php
namespace App\PO\Base;

use App\Commons\Kernels\PO;

abstract class AbstractRowPO extends PO
{
    use PrimaryKeyPOTrait;
    use SubsetFieldsPOTrait;
}
