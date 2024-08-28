<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoomRequest;
use App\Models\Room;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {

            $rooms = Room::forCurrentUser()->select(['id', 'name', 'avatar', 'country_id'])->get();
            return response()->json([
                'message' => 'rooms for login user',
                'code' => Response::HTTP_ACCEPTED,
                'error' => false,
                'data' => $rooms
            ]);
        } catch (Exception $e) {
            return response()->json([
                'massege' => 'An error occurred',
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'error' => true,
                'data' => []
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoomRequest $request)
    {
        try {

            $validatedData = $request->validated();
            $room = Room::create($validatedData);
            $room->updateAvatar($request);
            return response()->json([
                'message' => __('site.create_successfully'),
                'code' => Response::HTTP_CREATED,
                'error' => false,
                'data' => $room
            ]);
        } catch (Exception $e) {
            return response()->json([
                'massege' => 'An error occurred',
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'error' => true,
                'data' => []
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoomRequest $request, $id)
    {
        try {

            $room = Room::forCurrentUser()->findOrFail($id);
            $validatedData = $request->validated();
            $room->update($validatedData);
            $room->updateAvatar($request);
            return response()->json([
                'message' => __('site.update_successfully'),
                'code' => Response::HTTP_CREATED,
                'error' => false,
                'data' => $room
            ]);
        } catch (Exception $e) {
            return response()->json([
                'massege' => 'An error occurred',
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'error' => true,
                'data' => []
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $room = Room::forCurrentUser()->findOrFail($id);
            $room->delete();
            return response()->json([
                'message' => __('site.delete_successfully'),
                'code' => Response::HTTP_OK,
                'error' => false,
                'data' => []
            ]);
        } catch (Exception $e) {
            return response()->json([
                'massege' => 'An error occurred',
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'error' => true,
                'data' => []
            ]);
        }
    }
}
