<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feature;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AmenetiesController extends Controller
{

    public function __construct()
    {
        // Check permission inside the constructor
        if (!permission_check('Setup Manage')) {
            abort(404); // Return a 404 error if permission is not available
        }
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $ameneties = Feature::orderBy('id', 'desc')->get();

        return view('admin.ameneties.index', compact('ameneties'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.ameneties.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        DB::beginTransaction();
        try {
            $amenety = Feature::query()->create($request->input());
            $result = uploadFiletoMedia($request->file('icon'), 'ameneties');
            $amenety->icon = isset($result['media_id']) ? $result['media_id'] : null;
            $amenety->save();
            Db::commit();
        } catch (Exception $e) {
     
            DB::rollback();
            Session::flash('failed_msg', 'Failed..!' . $e->getMessage());
            return redirect()->back();
        }

        Session::flash('success_msg', 'Successfully Added');
        return  redirect()->route('admin.ameneties.index');
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
    public function edit($id)
    {
        //
        $amenety = Feature::where('id', $id)->first() ?? abort(404);
        return view('admin.ameneties.form', compact('amenety'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
     
        $amenety = Feature::where('id', $id)->first() ?? abort(404);
        //
        DB::beginTransaction();
        try {
            $amenety->fill($request->input());
    
            if((!$request->has('exist_image') && $amenety->icon != null)  || $request->hasFile('icon') ){
                deleteFilefromMedia($amenety->icon);
                $amenety->icon = null;
            }

            if($request->hasFile('icon')){
    
                $result = uploadFiletoMedia($request->file('icon'), 'ameneties');
                $amenety->icon = isset($result['media_id']) ? $result['media_id'] : null;
            }
            $amenety->save();

            Db::commit();
        } catch (Exception $e) {
         
            DB::rollback();
            Session::flash('failed_msg', 'Failed..!' . $e->getMessage());
            return redirect()->back();
        }

        Session::flash('success_msg', 'Successfully Updated');
        return  redirect()->route('admin.ameneties.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, Feature $Feature)
    {
        //
        DB::beginTransaction();
        try{
            $FeatureItem =  Feature::where('id', $id)->first() ?? abort(404);
            deleteFilefromMedia($FeatureItem->icon);
            $FeatureItem->delete();
            Db::commit();
        }
        catch(Exception $e){

            DB::rollback();
            Session::flash('failed_msg', 'Failed..!' . $e->getMessage());
            return redirect()->back();
        }
        Session::flash('success_msg', 'Successfully Deleted');
        return  redirect()->route('admin.ameneties.index');
    }
}
