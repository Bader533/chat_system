<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoomRequest;
use App\Models\City;
use App\Models\Country;
use App\Models\Room;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($data = null)
    {
        $kindData = $data;
        return view('dashboard.room.index', ['data' => $kindData]);
    }

    /**
     * get all countries to show it using js
     */
    public function getRooms(Request $request)
    {
        // Retrieve input values with sensible defaults
        $query = $request->input('query');
        $perPage = $request->input('per_page', 10);
        $kind = $request->input('kind');

        // Start building the query
        $roomsQuery = Room::query();

        // Filter by room type if provided
        if (!empty($kind)) {
            switch ($kind) {
                case 'home':
                    $roomsQuery->isHome();
                    break;
                case 'favorite':
                    $roomsQuery->isFavorite();
                    break;
            }
        }

        // Filter by search query if provided
        if (!empty($query)) {
            $roomsQuery->where('name', 'like', '%' . $query . '%');
        }

        // Paginate the results
        $contacts = $roomsQuery->paginate($perPage);

        // Return the view with the data
        return view('dashboard.room.room', ['contacts' => $contacts]);
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
    public function store(RoomRequest $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoomRequest $request, $slug)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slug)
    {
        //
    }

    /**
     * change room status
     */
    public function changeStatus(Request $request)
    {
        $room = Room::findOrFail($request->id);

        $room->status = !$room->status;

        $isSaved = $room->save();

        $message = $isSaved ? __('site.saved_successfully') : __('site.failed_to_save');

        return response()->json(['message' => $message], $isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }

    /**
     * change room is_home
     */
    public function changeIsHome(Request $request)
    {
        $room = Room::findOrFail($request->id);

        $room->is_home = !$room->is_home;

        $isSaved = $room->save();

        $message = $isSaved ? __('site.saved_successfully') : __('site.failed_to_save');

        return response()->json(['message' => $message], $isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }

    /**
     * change room is_favorite
     */
    public function changeIsFavorite(Request $request)
    {
        $room = Room::findOrFail($request->id);

        $room->is_favorite = !$room->is_favorite;

        $isSaved = $room->save();

        $message = $isSaved ? __('site.saved_successfully') : __('site.failed_to_save');

        return response()->json(['message' => $message], $isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }
}
