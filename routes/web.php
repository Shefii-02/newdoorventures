<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

require __DIR__ . '/auth.php';



Route::get('/mail', function () {
    try {
        Mail::raw('Hello World!', function ($message) {
            $message->to('shefii.indigital@gmail.com') // Set the recipient's email address
                    ->subject('Test Email');          // Set the subject of the email
        });
    
        echo "Email sent successfully.";
    } catch (\Exception $e) {
        echo "Failed to send email. Error: " . $e->getMessage();
    }
});

require __DIR__ . '/route/admin.php';

require __DIR__ . '/route/seller.php';
require __DIR__ . '/route/front.php';
