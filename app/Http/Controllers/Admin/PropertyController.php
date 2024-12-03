<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CustomField;
use App\Models\Facility;
use App\Models\Feature;
use App\Models\Furnishing;
use App\Models\PgRules;
use App\Models\Project;
use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $query = Property::orderByRaw("
                                        CASE 
                                            WHEN moderation_status = 'pending' THEN 1
                                            WHEN moderation_status = 'approved' THEN 2
                                            WHEN moderation_status = 'suspended' THEN 3
                                            ELSE 4
                                        END
                                    ");
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%$search%")
                    ->orWhere('location', 'LIKE', "%$search%")
                    ->orWhere('type', 'LIKE', "%$search%")
                    ->orWhere('moderation_status', 'LIKE', "%$search%");
            });
            // $query->whereHas('account', function ($q) use ($search) {
            //     $q->where('first_name', 'LIKE', "%$search%")
            //     ->orWhere('last_name', 'LIKE', "%$search%");
            // });
        }
       
        $properties = $query->paginate(10);

        // if ($request->ajax()) {
        //     $rows = view('admin.properties.items', compact('properties'))->render();
        //     $pagination = view('admin.properties.pagination', compact('properties'))->render();
        //     return response()->json(['rows' => $rows, 'pagination' => $pagination]);
        // }

    
        return view('admin.properties.index',compact('properties'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return abort(404);
        $categories = Category::where('status', 'published')->get();

        $projects   = Project::get();

        $has_rent   = Category::where('has_rent', 1)->get();

        $has_sell   = Category::where('has_sell', 1)->get();

        $has_pg     = Category::where('has_pg', 1)->get();

        $furnishing = Furnishing::where('status', 'published')->get();

        $facilities = Facility::where('status', 'published')->get();

        $features   = Feature::where('status', 'published')->get();

        $customFields = CustomField::get();

        $pg_rules = PgRules::orderBy('type', 'desc')->get();

        return view('admin.properties.form',compact( 'categories', 'projects', 'has_rent', 'has_sell', 'has_pg', 'furnishing', 'features', 'facilities', 'customFields', 'pg_rules'));
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
        $property = Property::findOrFail($id);
   
        return view('admin.properties.modal-content', compact('property'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        return abort(404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //

        $consult = Property::findOrFail($id);
        $consult->update($request->only('moderation_status'));

        return redirect()->route('admin.properties.index')->with('success', 'Status updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        return abort(404);
    }
}
