<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Console\Scheduling\Schedule;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->use([
        
        ]);
        //
    })
    ->withSchedule(function (Schedule $schedule) {
        $schedule->command('analytics:fetch-visitors');
        $schedule->command('analytics:fetch-top-devices');
        $schedule->command('analytics:fetch-top-referrers');
        $schedule->command('analytics:fetch-top-landing-pages');
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
