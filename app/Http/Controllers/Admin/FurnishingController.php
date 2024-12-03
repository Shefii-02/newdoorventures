<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Furnishing;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class FurnishingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $furnishing = Furnishing::orderBy('id', 'desc')->get();

        return view('admin.furnishing.index', compact('furnishing'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.furnishing.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        DB::beginTransaction();
        try {
            $furnishing = Furnishing::query()->create($request->input());
            $result = uploadFiletoMedia($request->file('icon'), 'furnishing-icons');
            $furnishing->icon = isset($result['media_id']) ? $result['media_id'] : null;
            $furnishing->save();
            Db::commit();
        } catch (Exception $e) {
            dd($e);
            DB::rollback();
            Session::flash('failed_msg', 'Failed..!' . $e->getMessage());
            return redirect()->back();
        }

        Session::flash('success_msg', 'Successfully Added');
        return redirect()->route('admin.furnishing.index');


      
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
        $furnishing = Furnishing::where('id', $id)->first() ?? abort(404);
        return view('admin.furnishing.form', compact('furnishing'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $furnishing = Furnishing::where('id', $id)->first() ?? abort(404);
        //
        DB::beginTransaction();
        try {
            $furnishing->fill($request->input());

            if ((!$request->has('exist_image') && $furnishing->icon != null)  || $request->hasFile('icon')) {
                deleteFilefromMedia($furnishing->icon);
                $furnishing->icon = null;
            }

            if ($request->hasFile('icon')) {

                $result = uploadFiletoMedia($request->file('icon'), 'furnishing-icons');
                $furnishing->icon = isset($result['media_id']) ? $result['media_id'] : null;
            }
            $furnishing->save();

            Db::commit();
        } catch (Exception $e) {

            DB::rollback();
            Session::flash('failed_msg', 'Failed..!' . $e->getMessage());
            return redirect()->back();
        }

        Session::flash('success_msg', 'Successfully Updated');
        return redirect()->route('admin.furnishing.index');
    }

    /**
     * Remove the specified resource from storage.
     */

     public function destroy($id)
     {
         //
         DB::beginTransaction();
         try{
             $furnishing =  Furnishing::where('id', $id)->first() ?? abort(404);
             deleteFilefromMedia($furnishing->icon);
             $furnishing->delete();
             Db::commit();
         }
         catch(Exception $e){
 
             DB::rollback();
             Session::flash('failed_msg', 'Failed..!' . $e->getMessage());
             return redirect()->back();
         }
         Session::flash('success_msg', 'Successfully Deleted');
         return  redirect()->route('admin.furnishing.index');
     }
  
}
