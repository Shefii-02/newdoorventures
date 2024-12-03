<?php
namespace App\Facades;

use Illuminate\Support\Facades\Facade;
use App\Class\SeoHelperService;

class SeoHelper extends Facade
{
    protected static function getFacadeAccessor()
    {
        return SeoHelperService::class;
    }
}
