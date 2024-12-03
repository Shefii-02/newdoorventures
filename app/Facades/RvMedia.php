<?php
namespace App\Facades;

use Illuminate\Support\Facades\Facade;
use App\Class\RvMediaService;

class RvMedia extends Facade
{
    protected static function getFacadeAccessor()
    {
        return RvMediaService::class;

    }
}
