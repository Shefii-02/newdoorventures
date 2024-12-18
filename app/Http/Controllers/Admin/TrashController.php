<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PgRules;
use App\Models\Project;
use App\Models\Property;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class TrashController extends Controller
{

    public function __construct()
    {
        // Check permission inside the constructor
        if (!permission_check('Trash')) {
            abort(404); // Return a 404 error if permission is not available
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $projects   = Project::withTrashed()->whereNotNull('deleted_at')->get();
        $properties = Property::withTrashed()->whereNotNull('deleted_at')->get();

        return view('admin.trash.index', compact('projects', 'properties'));
    }


    public function update($id, Request $request)
    {
        DB::beginTransaction();
        try {
            if ($request->has('property') && $request->property === 'restore') {
                $property = Property::withTrashed()->findOrFail($id);
                $property->restore();
            } elseif ($request->has('project') && $request->project === 'restore') {
                $project = Project::withTrashed()->findOrFail($id);
                $project->restore();
            } else {
                return abort(404, 'Invalid Request');
            }

            DB::commit();
            return redirect()->route('admin.trash.index')->with('success_msg', 'Successfully Restored!');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('failed_msg', 'Failed to restore: ' . $e->getMessage());
        }
    }
}
