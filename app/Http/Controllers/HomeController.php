<?php

namespace App\Http\Controllers;

use App\Models\Agency;
use App\Models\Room;
use App\Models\User;
use App\Models\Wallet;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * home page (dashboard)
     */
    public function index()
    {
        $this->authorize('Read-Dashboard');
        $user = User::query();
        $userCount = $user->count();
        $users = $user->take(10)->get();

        $agency = Agency::query();
        $agencyCount = $agency->count();
        $agencies = $agency->take(10)->get();

        $room = Room::query();
        $roomCount = $room->count();
        $roomActiveCount = $room->isActive()->count();
        $rooms = $room->take(10)->get();

        $wallet = Wallet::query();
        $walletCount = $wallet->count();
        $wallets = $wallet->take(10)->get();

        return view('dashboard.home.home', [
            'user_count' => $userCount,
            'users' => $users,
            'agency_count' => $agencyCount,
            'agencies' => $agencies,
            'room_count' => $roomCount,
            'rooms' => $rooms,
            'room_active_count' => $roomActiveCount,
            'wallet_count' => $walletCount,
            'wallets' => $wallets,

        ]);
    }
}
