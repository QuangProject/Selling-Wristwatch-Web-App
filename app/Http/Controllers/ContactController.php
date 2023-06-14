<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::all();
        return view('admin.contact.index')->with('contacts', $contacts);
    }

    public function list()
    {
        $contacts = Contact::all();
        return response()->json([
            'message' => 'Contacts retrieved successfully',
            'contacts' => $contacts
        ], 200);
    }

    public function store(Request $request)
    {
        try {
            $contact = Contact::create($request->all());
            return response()->json([
                'message' => 'Send contact successfully',
                'contact' => $contact
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Contact created failed',
                'error' => $th
            ], 400);
        }
    }

    public function show($id)
    {
        $contact = Contact::find($id);
        if (is_null($contact)) {
            return response()->json(['message' => 'Contact not found'], 404);
        }
        return response()->json([
            'message' => 'Contact retrieved successfully',
            'contact' => $contact
        ], 200);
    }

    public function update(Request $request, $id)
    {
        try {
            $contact = Contact::find($id);
            if (is_null($contact)) {
                return response()->json(['message' => 'Contact not found'], 404);
            }
            $contact->update($request->all());
            return response()->json([
                'message' => 'Contact updated successfully',
                'contact' => $contact
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Contact updated failed',
                'error' => $th
            ], 400);
        }
    }

    public function destroy($id)
    {
        // Logic to delete a user by ID
        $contact = Contact::find($id);
        if (is_null($contact)) {
            return response()->json(['message' => 'Contact not found'], 404);
        }
        $contact->delete();
        return response()->json(['message' => 'Contact was deleted'], 200);
    }
}
