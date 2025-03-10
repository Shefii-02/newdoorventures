<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $enquirys = Contact::orderBy('status', 'desc')->paginate('2');

        return view('admin.contacts.index', compact('enquirys'));
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
        $consult = Contact::findOrFail($id);
        return view('admin.contacts.modal-content', compact('consult'));
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
    public function update(Request $request, $id)
    {
        if (!permission_check('Enquiry Attend')) {
            return abort(404);
        }
        $consult = Contact::findOrFail($id);
        $consult->update($request->only('status'));

        return redirect()->route('admin.contact.index')->with('success', 'Contact Lead updated successfully!');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $contact = Contact::findOrFail($id) ?? abort(404);
        $contact->delete();
        return redirect()->route('admin.contact.index')->with('success', 'Contact Lead deleted successfully!');
    }
}
