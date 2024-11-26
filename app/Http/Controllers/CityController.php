<?php

namespace App\Http\Controllers;

use App\Http\Requests\CityRequest;
use App\Models\City;
use App\Models\Country;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('Read-Cities');

        return view('dashboard.city.index');
    }

    /**
     * get all countries to show it using js
     */

    public function getCities(Request $request)
    {
        $this->authorize('Read-Cities');

        $query = $request->input('query');
        $perPage = $request->input('per_page', 10);
        $data = City::query();

        if ($query == null) {
            $contacts = $data->paginate($perPage);
        } else {
            $contacts = $data->where('name_en', 'like', '%' . $query . '%')
                ->orWhere('name_ar', 'like', '%' . $query . '%')
                ->paginate($perPage);
        }

        return view('dashboard.city.city', ['contacts' => $contacts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('Create-City');
        $countries = Country::select(['id', 'name_en', 'name_ar'])->get();
        return view('dashboard.city.create', ['countries' => $countries]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CityRequest $request)
    {
        $this->authorize('Create-City');
        $validatedData = $request->validated();
        $city = City::create($validatedData);
        $city->updateAvatar($request);
        return response()->json(['message' => __('site.create_successfully')], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {
        $this->authorize('Update-City');

        $countries = Country::select(['id', 'name_en', 'name_ar'])->get();
        $city = City::whereSlug($slug)->firstOrFail();
        return view('dashboard.city.edit', ['city' => $city, 'countries' => $countries]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CityRequest $request, $slug)
    {
        $this->authorize('Update-City');
        $city = City::whereSlug($slug)->firstOrFail();
        $validatedData = $request->validated();
        $city->update($validatedData);
        $city->updateAvatar($request);
        return response()->json(['message' => __('site.update_successfully')], Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slug)
    {
        $this->authorize('Read-Cities');

        $city = City::whereSlug($slug)->firstOrFail();
        $city->delete();
        return response()->json(['message' => __('site.delete_successfully')], Response::HTTP_CREATED);
    }
}
