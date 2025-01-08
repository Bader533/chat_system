<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AgencyHost;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AgencyHostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {

            $agencyHosts = AgencyHost::with(['user:id,name,email,avatar'])->isActive()->select(['id', 'user_id'])->paginate(10);

            return response()->json([
                'message' => 'agencyHosts data',
                'code' => Response::HTTP_ACCEPTED,
                'error' => false,
                'data' => $agencyHosts
            ], Response::HTTP_ACCEPTED);
        } catch (Exception $e) {
            return response()->json([
                'massege' => 'An error occurred',
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'error' => true,
                'data' => []
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * show current user data
     */
    public function show($id)
    {
        try {

            $user = AgencyHost::with(['user:id,name,email,avatar'])->isActive()->select(['id', 'user_id'])->where('id', $id)->first();

            if ($user == null) {
                return response()->json([
                    'message' => 'Agency host not found',
                    'code' => Response::HTTP_BAD_REQUEST,
                    'error' => true,
                    'data' => []
                ], Response::HTTP_BAD_REQUEST);
            }


            return response()->json([
                'message' => 'Agency Host Data',
                'code' => Response::HTTP_OK,
                'error' => false,
                'data' => $user
            ], Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json([
                'massege' => 'An error occurred' . $e,
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'error' => true,
                'data' => []
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * show current user data
     */
    public function beAgencyHost($id)
    {
        try {

            $user = auth()->user();
            $agencyHost = AgencyHost::where('id', $id)->first();

            if ($agencyHost == null) {
                return response()->json([
                    'message' => 'Agency host not found',
                    'code' => Response::HTTP_BAD_REQUEST,
                    'error' => true,
                    'data' => []
                ], Response::HTTP_BAD_REQUEST);
            }

            $agencyHost->users()->syncWithoutDetaching([$user->id => ['status' => 0]]);

            return response()->json([
                'message' => 'The application has been submitted',
                'code' => Response::HTTP_OK,
                'error' => false,
                'data' => []
            ], Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json([
                'massege' => 'An error occurred' . $e,
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'error' => true,
                'data' => []
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
