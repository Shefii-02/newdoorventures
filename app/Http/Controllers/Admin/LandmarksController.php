<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feature;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class LandmarksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $landmarks = Feature::orderBy('id', 'desc')->get();

        return view('admin.landmarks.index', compact('landmarks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.landmarks.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $amenety = Feature::query()->create($request->input());
            $result = uploadFiletoMedia($request->file('icon'), 'landmarks');
            $amenety->icon = isset($result['media_id']) ? $result['media_id'] : null;
            $amenety->save();
            Db::commit();
        } catch (Exception $e) {
            dd($e);
            DB::rollback();
            Session::flash('failed_msg', 'Failed..!' . $e->getMessage());
            return redirect()->back();
        }

        Session::flash('success_msg', 'Successfully Added');
        return redirect()->route('admin.landmark.index');
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
        $landmark=Feature::where('id', $id)->first() ?? abort(404);

        return view('admin.landmarks.form', compact('landmark'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $landmark = Feature::where('id', $id)->first() ?? abort(404);
        //
        DB::beginTransaction();
        try {
            $landmark->fill($request->input());
    
            if((!$request->has('exist_image') && $landmark->icon != null)  || $request->hasFile('icon') ){
                deleteFilefromMedia($landmark->icon);
                $landmark->icon = null;
            }

            if($request->hasFile('icon')){
    
                $result = uploadFiletoMedia($request->file('icon'), 'landmarks');
                $landmark->icon = isset($result['media_id']) ? $result['media_id'] : null;
            }
            $landmark->save();

            Db::commit();
        } catch (Exception $e) {
         
            DB::rollback();
            Session::flash('failed_msg', 'Failed..!' . $e->getMessage());
            return redirect()->back();
        }

        Session::flash('success_msg', 'Successfully Updated');
        return redirect()->route('admin.landmark.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        DB::beginTransaction();
        try{
            $ffeatureItem =  Feature::where('id', $id)->first() ?? abort(404);
            deleteFilefromMedia($ffeatureItem->icon);
            $ffeatureItem->delete();
            Db::commit();
        }
        catch(Exception $e){

            DB::rollback();
            Session::flash('failed_msg', 'Failed..!' . $e->getMessage());
            return redirect()->back();
        }
        Session::flash('success_msg', 'Successfully Deleted');
        return  redirect()->route('admin.landmark.index');
    }
}
