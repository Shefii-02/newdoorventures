<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Contact;
use App\Models\Property;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AccountsController extends Controller
{
    use \App\Emails;
    
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
        $pending_accounts   = Account::where('status','pending')->orderBy('created_at', 'desc')->get();
        $approved_accounts  = Account::where('status','approved')->orderBy('created_at', 'desc')->get();
        $suspended_accounts = Account::where('status','suspended')->orderBy('created_at', 'desc')->get();

        return view('admin.accounts.index',compact('pending_accounts','approved_accounts','suspended_accounts'));
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
        return view('admin.accounts.single', compact('account'));
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

        if (permission_check('Set Staff'))
        {
            $account->is_staff     = $request->has('is_staff') ? $request->is_staff : 0;
            $account->auto_approvel= $request->has('is_staff') ? $request->is_staff : 0;
        }
        
        $account->save();

        if($request->only('status') == 'approved' && $account->status != 'approved' ){
            $this->accountApproved($account);
        }
        else if($request->only('status') == 'suspended' && $account->status != 'suspended' ){
            $this->accountSuspended($account);
        }


       
        return redirect()->route('admin.accounts.index')->with('success', 'status updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id,Request $request)
    {
        //

        if (!permission_check('Account Delete'))
        {
            return abort(404);
        }

        if (auth('web')->user()->acc_type == 'superadmin') {
            
            $account = Account::withTrashed()->whereId($id)->first() ?? abort(404);
            DB::beginTransaction();
            try {
                
                Property::where('author_id', $account->id)->delete();
                $account->delete();

                DB::commit();
                Session::flash('success_msg', 'Successfully Deleted');
                if ($request->has('from') && $request->from == 'trash') {
                    return redirect()->route('admin.trash.index')->with('success_msg', 'Account  deleted!');
                }
                return redirect()->back()->with('success_msg', 'Account deleted!');
            } catch (Exception $e) {
                DB::rollBack();
                Session::flash('failed_msg', $e->getMessage());
                // Return error response if something goes wrong
                return redirect()->back();
            }
        } else {
     
            DB::beginTransaction();
            try {
                $account = Account::withTrashed()->whereId($id)->first() ?? abort(404);
                Property::where('author_id', $account->id)->delete();
                $account->delete();
                DB::commit();
                Session::flash('success_msg', 'Successfully Deleted');
                return redirect()->back()->with('success_msg', 'Account deleted!');
            } catch (Exception $e) {
                DB::rollBack();
                Session::flash('failed_msg', $e->getMessage());
                return redirect()->back();
            }
        }

    }
}
