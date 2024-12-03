<?php
namespace App\Facades;

use Illuminate\Support\Facades\Facade;
use App\Class\ThemeService;

class Theme extends Facade
{
    protected static function getFacadeAccessor()
    {
        return ThemeService::class;
    }
}
