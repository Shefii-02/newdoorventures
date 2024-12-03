<?php
namespace App\Facades;

use Illuminate\Support\Facades\Facade;
use App\Class\BaseHelperService;

class BaseHelper extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return BaseHelperService::class;
    }
}
