<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Contact;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AccountsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!permission_check('Account List'))
        {
            return abort(404);
        }
        //
        $accounts = Account::orderBy('status', 'desc')->get();

        return view('admin.accounts.index',compact('accounts'));
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
        $account = Account::findOrFail($id);
        return view('admin.accounts.modal-content', compact('account'));
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
        if (!permission_check('Account Approvel'))
        {
            return abort(404);
        }
      
        $account = Account::findOrFail($id);
        $account->update($request->only('status'));
        $account->is_staff     = $request->has('is_staff') ? $request->is_staff : 0;
        $account->auto_approvel= $request->has('is_staff') ? $request->is_staff : 0;
        $account->save();
       
        return redirect()->route('admin.accounts.index')->with('success', 'status updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //

    }
}
