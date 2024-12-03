<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomField;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class MoreDetailsFieldsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $customfileds = CustomField::orderBy('created_at', 'desc')->get();

        return view('admin.custom-fields.index',compact('customfileds'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.custom-fields.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        DB::beginTransaction();
        try {
            CustomField::query()->create($request->input());
            Db::commit();
        } catch (Exception $e) {
            dd($e);
            DB::rollback();
            Session::flash('failed_msg', 'Failed..!' . $e->getMessage());
            return redirect()->back();
        }

        Session::flash('success_msg', 'Successfully Added');
        return  redirect()->route('admin.custom-fields.index');
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
        $customField = CustomField::where('id', $id)->first() ?? abort(404);
        return view('admin.custom-fields.form', compact('customField'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $customField = CustomField::where('id', $id)->first() ?? abort(404);
        DB::beginTransaction();
        try {  
            $customField->fill($request->input());
            $customField->save();
            Db::commit();
        } catch (Exception $e) {
            DB::rollback();
            Session::flash('failed_msg', 'Failed..!' . $e->getMessage());
            return redirect()->back();
        }

        Session::flash('success_msg', 'Successfully Updated');
        return  redirect()->route('admin.custom-fields.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        CustomField ::where('id', $id)->delete();
        Session::flash('success_msg', 'Successfully Deleted');
        return  redirect()->route('admin.custom-fields.index');
    }
}
