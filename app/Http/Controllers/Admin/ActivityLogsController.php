<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AccountActivityLog;
use Illuminate\Http\Request;

class ActivityLogsController extends Controller
{

    public function __construct()
    {
        // Check permission inside the constructor
        if (!permission_check('Activity Logs')) {
            abort(404); // Return a 404 error if permission is not available
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $activities = AccountActivityLog::orderBy('created_at', 'desc')->paginate(50);

        return view('admin.activity.index',compact('activities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
