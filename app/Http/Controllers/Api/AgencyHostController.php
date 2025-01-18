<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AgencyHost;
use App\Models\AgencyPoint;
use App\Models\Task;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Carbon\Carbon;

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

    /**
     * send points to agency host 
     */
    public function sendPoitsToAgencyHost(Request $request)
    {
        try {

            $allowedFields = ['diamonds', 'gold', 'silver'];
            $field = $request->get('value');

            if (!in_array($field, $allowedFields)) {
                return response()->json([
                    'message' => 'Invalid value',
                    'code' => Response::HTTP_BAD_REQUEST,
                    'error' => true,
                    'data' => []
                ], Response::HTTP_BAD_REQUEST);
            }

            $user = auth()->user();
            $agencyHost = AgencyHost::where('id', $request->get('agency_host_id'))->first();

            if ($agencyHost == null) {
                return response()->json([
                    'message' => 'Agency host not found' . $request->get('agency_host_id'),
                    'code' => Response::HTTP_BAD_REQUEST,
                    'error' => true,
                    'data' => []
                ], Response::HTTP_BAD_REQUEST);
            }

            $useWallet = $user->wallet->{$request->get('value')};

            if ($useWallet < $request->quantity) {
                return response()->json([
                    'message' => 'Not enough points',
                    'code' => Response::HTTP_BAD_REQUEST,
                    'error' => true,
                    'data' => []
                ], Response::HTTP_BAD_REQUEST);
            }

            AgencyPoint::create([
                'agency_host_id' => $request->get('agency_host_id'),
                'user_id' => $request->get('user_id'),
                $request->get("value") => $request->quantity
            ]);

            $user->wallet->update([$request->get('value') => $useWallet - $request->quantity]);

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

    // public function DistributionOfProfits()
    // {
    //     $agencyAuth = auth()->user();

    //     // جلب كل البيانات
    //     $records = AgencyPoint::where('agency_host_id', $agencyAuth->agencyHost->id)->get();

    //     $data = [];
    //     // إضافة عدد الأيام لكل سجل
    //     $recordsWithDays = $records->map(function ($record) {
    //         $data['days_since_added'] = Carbon::parse($record->created_at)->diffInDays(Carbon::now());
    //         $data['total_diamonds'] += $record->diamonds;
    //         $data['total_gold'] += $record->gold;
    //         $data['total_silver'] += $record->silver;
    //         return $record;
    //     });
    //     dd($data);
    //     return response()->json($recordsWithDays);
    // }

    public function DistributionOfProfits()
    {
        $agencyAuth = auth()->user();
        $admin = User::where('type', 0)->first();
        // $host = 
        $records = AgencyPoint::where('agency_host_id', $agencyAuth->agencyHost->id)->get();
        $task = Task::where('id', $agencyAuth->agencyHost->task_id)->first();
        $data = [
            'total_diamonds' => 0,
            'total_gold' => 0,
            'total_silver' => 0,
            'days_since_added' => 0
        ];

        $records->each(function ($record) use (&$data) {
            $data['total_diamonds'] += $record->diamonds;
            $data['total_gold'] += $record->gold;
            $data['total_silver'] += $record->silver;
            $data['days_since_added'] += Carbon::parse($record->created_at)->diffInDays(Carbon::now());
        });

        if ($data['days_since_added'] <= $task->days) {
        }
    }


    public function getDaysSinceAdded() {}
}
