<?php
namespace App\DTO\Base;

use App\Commons\Kernels\DTO;

abstract class AbstractListDTO extends DTO
{
    use PaginationDTOTrait;
    use OrderByDTOTrait;
    use SubsetFieldsDTOTrait;
}
