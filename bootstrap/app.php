<?php

use App\Http\Middleware\CheckAccountStatus;
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
        $middleware->alias([
            'check.account.status' => \App\Http\Middleware\CheckAccountStatus::class,
        ]);



        // $middleware->use([
        //     CheckAccountStatus::class,
            
        // ]);

        $middleware->validateCsrfTokens(except: [
            'account/*',
            'admin/*',
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
        $exceptions->report(function (Throwable $exception) {
            // if (!env('APP_DEBUG')) {
                $content['message'] = $exception->getMessage();
                $content['file'] = $exception->getFile();
                $content['line'] = $exception->getLine();
                $content['trace'] = $exception->getTrace();
    
                $content['url'] = request()->url();
                $content['body'] = request()->all();
                $content['ip'] = request()->ip();
                \App\Emails::sendError($content);
            // }
        });
    })->create();
