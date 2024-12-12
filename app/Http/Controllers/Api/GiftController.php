<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Gift;
use App\Models\GiftTransaction;
use App\Models\User;
use App\Models\UserGift;
use App\Services\WalletService;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GiftController extends Controller
{
    public function index()
    {
        try {
            $gifts = Gift::isActive()
                ->paginate(8)
                ->through(fn($gift) => $gift->makeHidden(['created_at', 'updated_at', 'status', 'slug']));


            return response()->json([
                'message' => 'all gifts data',
                'code' => Response::HTTP_ACCEPTED,
                'error' => false,
                'data' => $gifts
            ], Response::HTTP_ACCEPTED);
            //
        } catch (Exception $e) {
            return response()->json([
                'massege' => $e,
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'error' => true,
                'data' => []
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function sendGift(Request $request, WalletService $walletService)
    {
        $sender = auth()->user();
        $receiver = User::find($request->receiver_id);
        $gift = Gift::find($request->gift_id);
        $giftType = $gift->type_points; //diamonds
        $senderBalance = $sender->wallet->{$giftType};

        if (!$receiver || !$gift) {
            return response()->json([
                'message' => 'Invalid user or gift',
                'code' => Response::HTTP_BAD_REQUEST,
                'error' => true,
                'data' => []
            ], Response::HTTP_BAD_REQUEST);
        }

        if ($senderBalance < $gift->value_points) {
            return response()->json([
                'message' => 'Not enough points',
                'code' => Response::HTTP_BAD_REQUEST,
                'error' => true,
                'data' => []
            ], Response::HTTP_BAD_REQUEST);
        }

        // send the gift
        UserGift::create([
            'sender_id' => $sender->id,
            'receiver_id' => $receiver->id,
            'gift_id' => $gift->id,
            'message' => $request->message,
            'sent_at' => now()
        ]);

        // update data
        $sender->wallet->update([$gift->type_points => $senderBalance - $gift->value_points]);

        // store transactions
        GiftTransaction::create([
            'user_id' => $sender->id,
            'gift_id' => $gift->id,
            'points' => $gift->value_points,
        ]);

        return response()->json([
            'message' => 'Gift sent successfully',
            'code' => Response::HTTP_OK,
            'error' => false,
            'data' => []
        ], Response::HTTP_OK);
    }

    public function giftConversion(Request $request)
    {
        try {

            $user = auth()->user();
            $gift = Gift::find($request->gift_id);
            $transaction = $user->transactions->where('id', $request->gift_id)->first();
            $wallet = $user->wallet;
            $wallet->increment($transaction->gift->type_points, $transaction->gift->value_points);
            $transaction->delete();

            return response()->json([
                'message' => 'The gift was converted into points',
                'code' => Response::HTTP_ACCEPTED,
                'error' => false,
                'data' => []
            ], Response::HTTP_ACCEPTED);
            //
        } catch (Exception $e) {
            return response()->json([
                'massege' => $e,
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'error' => true,
                'data' => []
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
