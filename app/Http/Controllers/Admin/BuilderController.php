<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Investor;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class BuilderController extends Controller
{

   public function index(Request $request)
   {
       $builders = Investor::orderBy('created_at', 'desc')->get();

       return view('admin.builders.index',compact('builders'));
   }

   /**
    * Show the form for creating a new resource.
    */
   public function create()
   {
       //
       return view('admin.builders.form');
   }

   /**
    * Store a newly created resource in storage.
    */
   public function store(Request $request)
   {
       //
       DB::beginTransaction();
       try {
           
        Investor::query()->create($request->input());
           DB::commit();
       } catch (Exception $e) {
           DB::rollback();
           Session::flash('failed_msg', 'Failed..!' . $e->getMessage());
           return redirect()->back();
       }

       Session::flash('success_msg', 'Successfully Added');
       return  redirect()->route('admin.builders.index');
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
       $builder=Investor::where('id', $id)->first()  ?? abort(404);
       return view('admin.builders.form', compact('builder'));
   }

   /**
    * Update the specified resource in storage.
    */
   public function update(Request $request, string $id)
   {
       //
       $builder=Investor::where('id', $id)->first() ?? abort(404);
       DB::beginTransaction();
       try {
       
           $builder->fill($request->input());

           $builder->save();

           Db::commit();
       } catch (Exception $e) {
           DB::rollback();
           Session::flash('failed_msg', 'Failed..!' . $e->getMessage());
           return redirect()->back();
       }

       Session::flash('success_msg', 'Successfully Updated');
       return  redirect()->route('admin.builders.index');
   }

   /**
    * Remove the specified resource from storage.
    */
   public function destroy(Request $request, string $id)
   {
       //
       Investor::where('id', $id)->delete() ?? abort(404);
     
       Session::flash('success_msg', 'Successfully Deleted');
       return  redirect()->route('admin.builders.index');
   }
}
