<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoomTypeRequest;
use App\Models\RoomType;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoomTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.roomtype.index');
    }

    /**
     * get all countries to show it using js
     */

    public function getRoomTpyes(Request $request)
    {
        $query = $request->input('query');
        $perPage = $request->input('per_page', 10);
        $data = RoomType::query();

        if ($query == null) {
            $contacts = $data->paginate($perPage);
        } else {
            $contacts = $data->where('name', 'like', '%' . $query . '%')
                ->paginate($perPage);
        }

        return view('dashboard.roomtype.roomtype', ['contacts' => $contacts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.roomtype.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoomTypeRequest $request)
    {
        $validatedData = $request->validated();
        $roomtype = RoomType::create($validatedData);
        $roomtype->updateAvatar($request);
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
        $roomtype = RoomType::whereSlug($slug)->firstOrFail();
        return view('dashboard.roomtype.edit', ['roomtype' => $roomtype]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoomTypeRequest $request, $slug)
    {
        $roomtype = RoomType::whereSlug($slug)->firstOrFail();
        $validatedData = $request->validated();
        $roomtype->update($validatedData);
        $roomtype->updateAvatar($request);
        return response()->json(['message' => __('site.update_successfully')], Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slug)
    {
        $roomtype = RoomType::whereSlug($slug)->firstOrFail();
        $roomtype->delete();
        return response()->json(['message' => __('site.delete_successfully')], Response::HTTP_CREATED);
    }
}
