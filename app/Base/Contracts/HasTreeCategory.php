<?php

namespace App\Base\Contracts;

interface HasTreeCategory
{
    public static function updateTree(array $data): void;
}
