<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $catgeories = Category::orderBy('created_at', 'desc')->get();

        return view('admin.categories.index',compact('catgeories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.categories.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
 
        DB::beginTransaction();
        try {
            if ($request->input('is_default')) {
                Category::query()->where('id', '>', 0)->update(['is_default' => 0]);
            }
            $category = Category::query()->create($request->input());
            Db::commit();
        } catch (Exception $e) {
            DB::rollback();
            Session::flash('failed_msg', 'Failed..!' . $e->getMessage());
            return redirect()->back();
        }

        Session::flash('success_msg', 'Successfully Added');
        return  redirect()->route('admin.categories.index');
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
        
        $category = Category::where('id', $id)->first() ?? abort(404);
        return view('admin.categories.form', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        //
        $category = Category::where('id', $id)->first() ?? abort(404);
        DB::beginTransaction();
        try {
            if ($request->input('is_default')) {
                Category::query()->where('id', '!=', $category->getKey())->update(['is_default' => 0]);
            }

            $category->fill($request->input());

            $category->save();

            Db::commit();
        } catch (Exception $e) {
            DB::rollback();
            Session::flash('failed_msg', 'Failed..!' . $e->getMessage());
            return redirect()->back();
        }

        Session::flash('success_msg', 'Successfully Updated');
        return  redirect()->route('admin.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
  
        //
        Category::where('id', $id)->delete() ?? abort(404);

        Session::flash('success_msg', 'Successfully Deleted');
        return  redirect()->route('admin.categories.index');
    }
}
