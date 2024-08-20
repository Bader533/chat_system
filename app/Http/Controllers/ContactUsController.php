<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ContactUsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.contact.index');
    }

    public function getContact(Request $request)
    {
        $query = $request->input('query');
        $perPage = $request->input('per_page', 10);
        $data = ContactUs::query();

        if ($query == null) {
            $contacts = $data->paginate($perPage);
        } else {
            $contacts = $data->where('f_name', 'like', '%' . $query . '%')
                ->orWhere('l_name', 'like', '%' . $query . '%')
                ->orWhere('email', 'like', '%' . $query . '%')
                ->paginate($perPage);
        }

        return view('dashboard.contact.contact', ['contacts' => $contacts]);
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
    public function show($slug)
    {
        $contact = ContactUs::where('slug', $slug)->firstOrFail();
        return view('dashboard.contact.show', ['contact' => $contact]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ContactUs $contactUs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ContactUs $contactUs)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $contact = ContactUs::findOrFail($id);
        $contact->delete();
        return response()->json(['message' => __('site.delete_successfully')], Response::HTTP_CREATED);
    }
}
