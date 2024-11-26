<?php

namespace App\Http\Controllers;

use App\Http\Requests\AgencyRequest;
use App\Models\Agency;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AgencyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('Read-Egencies');
        return view('dashboard.agency.index');
    }

    /**
     * get all countries to show it using js
     */
    public function getAgencies(Request $request)
    {
        $this->authorize('Read-Egencies');

        $query = $request->input('query');
        $perPage = $request->input('per_page', 10);
        $data = Agency::query();

        if ($query == null) {
            $contacts = $data->paginate($perPage);
        } else {
            $contacts = $data->where('name_en', 'like', '%' . $query . '%')
                ->orWhere('name_ar', 'like', '%' . $query . '%')
                ->paginate($perPage);
        }

        return view('dashboard.agency.agency', ['contacts' => $contacts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('Create-Egency');

        return view('dashboard.agency.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AgencyRequest $request)
    {
        $this->authorize('Create-Egency');
        $validatedData = $request->validated();
        $country = Agency::create($validatedData);
        $country->updateAvatar($request);
        return response()->json(['message' => __('site.create_successfully')], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $this->authorize('Show-Egency');
        $agency = Agency::whereSlug($slug)->firstOrFail();
        return view('dashboard.agency.show', ['agency' => $agency]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {
        $this->authorize('Update-Egency');

        $agency = Agency::whereSlug($slug)->firstOrFail();
        return view('dashboard.agency.edit', ['agency' => $agency]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AgencyRequest $request, $slug)
    {
        $this->authorize('Update-Egency');
        $country = Agency::whereSlug($slug)->firstOrFail();
        $validatedData = $request->validated();
        $country->update($validatedData);
        $country->updateAvatar($request);
        return response()->json(['message' => __('site.update_successfully')], Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Agency $agency)
    {
        //
    }

    public function getData(Request $request)
    {
        $this->authorize('Show-Egency');

        // Retrieve input values with sensible defaults
        $query = $request->input('query');
        $perPage = $request->input('per_page', 10);
        $userId = $request->input('userId');

        // Start building the query
        $data = Agency::findOrFail($userId);

        if ($data) {
            $contacts = $data->wallets()->paginate($perPage);
            // Return the view with the data
            return view('dashboard.agency.table.wallet', ['contacts' => $contacts]);
        }
    }
}
