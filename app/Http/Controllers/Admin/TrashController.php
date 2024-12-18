<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PgRules;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class TrashController extends Controller
{

    public function __construct()
    {
        // Check permission inside the constructor
        if (!permission_check('Trash')) {
            abort(404); // Return a 404 error if permission is not available
        }
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


    }


}