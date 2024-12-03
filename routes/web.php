<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;


require __DIR__.'/auth.php';


require __DIR__.'/route/front.php';

require __DIR__.'/route/admin.php';

require __DIR__.'/route/seller.php';