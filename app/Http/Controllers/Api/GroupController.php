<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\GroupRequest;
use App\Models\Group;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {

            $rooms = Group::forCurrentUser()->isActive()
                ->select(['id', 'name', 'avatar'])
                ->get();

            return response()->json([
                'message' => 'groups for login user',
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
    public function store(GroupRequest $request)
    {
        try {

            $validatedData = $request->validated();
            $group = Group::create($validatedData);
            // dd('ss');
            $group->updateAvatar($request);

            return response()->json([
                'message' => __('site.create_successfully'),
                'code' => Response::HTTP_CREATED,
                'error' => false,
                'data' => $group
            ]);
        } catch (Exception $e) {
            return response()->json([
                'massege' => 'An error occurred' . $e,
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'error' => true,
                'data' => []
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GroupRequest $request, $id)
    {
        try {

            $room = Group::forCurrentUser()->isActive()->findOrFail($id);
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
            $room = Group::forCurrentUser()->isActive()->findOrFail($id);
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
