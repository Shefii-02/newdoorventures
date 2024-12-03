<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Configration;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ConfigrationController extends Controller
{
   /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $configration = Configration::orderBy('created_at', 'desc')->get();
        return view('admin.configration.index',compact('configration'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.configration.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        DB::beginTransaction();
        try {
            $rule = Configration::query()->create($request->input());
            $result = uploadFiletoMedia($request->file('icon'), 'configuration');
            $rule->icon = isset($result['media_id']) ? $result['media_id'] : null;
            $rule->save();
            Db::commit();
        } catch (Exception $e) {
            DB::rollback();
            Session::flash('failed_msg', 'Failed..!' . $e->getMessage());
            return redirect()->back();
        }

        Session::flash('success_msg', 'Successfully Added');
        return redirect()->route('admin.configration.index');

       
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
        $configration = Configration::where('id', $id)->first() ?? abort(404);
        return view('admin.configration.form', compact('configration'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id )
    {
        //
        $rule = Configration::where('id', $id)->first() ?? abort(404);
        //
        DB::beginTransaction();
        try {
            $rule->fill($request->input());

            if ((!$request->has('exist_image') && $rule->icon != null)  || $request->hasFile('icon')) {
                deleteFilefromMedia($rule->icon);
                $rule->icon = null;
            }

            if ($request->hasFile('icon')) {

                $result = uploadFiletoMedia($request->file('icon'), 'configuration');
                $rule->icon = isset($result['media_id']) ? $result['media_id'] : null;
            }
            $rule->save();

            Db::commit();
        } catch (Exception $e) {

            DB::rollback();
            Session::flash('failed_msg', 'Failed..!' . $e->getMessage());
            return redirect()->back();
        }

        Session::flash('success_msg', 'Successfully Updated');
        return redirect()->route('admin.configration.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id )
    {
        //
        DB::beginTransaction();
         try{
             $rule =  Configration::where('id', $id)->first() ?? abort(404);
             deleteFilefromMedia($rule->icon);
             $rule->delete();
             Db::commit();
         }
         catch(Exception $e){
 
             DB::rollback();
             Session::flash('failed_msg', 'Failed..!' . $e->getMessage());
             return redirect()->back();
         }
         Session::flash('success_msg', 'Successfully Deleted');
         return  redirect()->route('admin.configration.index');

    }
}
