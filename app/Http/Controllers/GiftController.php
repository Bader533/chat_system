<?php

namespace App\Http\Controllers;

use App\Http\Requests\GiftRequest;
use App\Models\Gift;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GiftController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $this->authorize('Read-Cities');

        return view('dashboard.gift.index');
    }

    /**
     * get all gifts to show it using js
     */
    public function getGifts(Request $request)
    {
        // $this->authorize('Read-Cities');

        $query = $request->input('query');
        $perPage = $request->input('per_page', 10);
        $data = Gift::query();

        if ($query == null) {
            $contacts = $data->paginate($perPage);
        } else {
            $contacts = $data->where('name_en', 'like', '%' . $query . '%')
                ->orWhere('name_ar', 'like', '%' . $query . '%')
                ->paginate($perPage);
        }

        return view('dashboard.gift.gifts', ['contacts' => $contacts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $this->authorize('Create-City');

        return view('dashboard.gift.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GiftRequest $request)
    {
        // $this->authorize('Create-City');

        $validatedData = $request->validated();
        $gift = Gift::create($validatedData);
        $gift->updateAvatar($request);
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
        // $this->authorize('Update-City');

        $gift = Gift::whereSlug($slug)->firstOrFail();
        return view('dashboard.gift.edit', ['gift' => $gift]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GiftRequest $request, $slug)
    {
        // $this->authorize('Update-City');

        $gift = Gift::whereSlug($slug)->firstOrFail();
        $validatedData = $request->validated();
        $gift->update($validatedData);
        $gift->updateAvatar($request);
        return response()->json(['message' => __('site.update_successfully')], Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slug)
    {
        // $this->authorize('Read-Cities');

        $gift = Gift::whereSlug($slug)->firstOrFail();
        $gift->delete();
        return response()->json(['message' => __('site.delete_successfully')], Response::HTTP_CREATED);
    }
}
