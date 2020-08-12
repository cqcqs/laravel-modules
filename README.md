# laravel-modules

基于 `Laravel7` 实现的一套开发规范，在原路由层（Route）、控制器层（Controller）上增加数据传输层（DTO）、业务逻辑层（Service）、数据映射层（Repository），并且建议以面向对象的思想进行开发。

> 项目正逐步完善中……

## Controller

Demo

```$xslt
public function list() : ResponseHelper
{
    $commonDTO = new CommonDTO([
        'id' => $request->post('id')
    ]);

    return ServiceHelper::make('Api\\V1\\LiveService')->list($commonDTO);
}
```

## DTO

```$xslt
$commonDTO = new CommonDTO();
$commonDTO->setId(request()->route('id'));
```

## Service

```$xslt
php artisan make:service LiveService;
```

LiveService.php

```$xslt
ServiceHelper::make('Api\\V1\\LiveService')->list($commonDTO);

class LiveService extends Service
{
    /**
     * @param CommonDTO $commonDTO
     * @return ResponseHelper
     */
    public function list(CommonDTO $commonDTO) : ResponseHelper
    {
    }
}
```

## Repository

```$xslt
php artisan make:model Models/Live

php artisan make:repository LiveRepository
```

LiveRepository.php

```$xslt
use App\Models\Live;

public function model()
{
    return Live::class;
}
```

LiveService.php

```$xslt
public function __construct(LiveRepository $live)
{
    $this->live = $live;
}

/**
* @return ResponseHelper
*/
public function list() : ResponseHelper
{
    $list = $this->live->all();

    $response = new ResponseHelper();
    $response->setData($list->toArray());
    return $response;
}
```

## Link

Blog：[Stephen Blog](https://www.stephen520.cn/)

> 正在完善，并且后期将提供composer包安装
