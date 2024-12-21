<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Consult;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ConsultsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $consults_unreaded = Consult::where('status','unread')->orderBy('status', 'desc')->paginate(50);
        $consults_attended = Consult::where('status','attended')->orderBy('status', 'desc')->paginate(50);
        return view('admin.consults.index', compact('consults_unreaded','consults_attended'));
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
        $consult = Consult::findOrFail($id);
        return view('admin.consults.modal-content', compact('consult'));
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function update(Request $request, $id)
    {

        if(!permission_check('Leads Attend')){
            return abort(404);
        }

        $consult = Consult::findOrFail($id);
        $consult->update($request->only('status'));

        return redirect()->route('admin.consults.index')->with('success', 'Status updated successfully!');
    }
}
