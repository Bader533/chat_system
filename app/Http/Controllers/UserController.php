<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    /**
     * get all users
     */
    public function index()
    {
        $this->authorize('Read-Users');
        return view('dashboard.user.index');
    }

    /**
     * get all users as js
     */
    public function getUser(Request $request)
    {
        $this->authorize('Read-Users');
        $query = $request->input('query');
        $perPage = $request->input('per_page', 10);
        $data = User::query();

        if ($query == null) {
            $users = $data->paginate($perPage);
        } else {
            $users = $data->where('name', 'like', '%' . $query . '%')
                ->paginate($perPage);
        }

        return view('dashboard.user.user', ['users' => $users]);
    }

    /**
     * get user data
     */
    public function show($slug)
    {
        $this->authorize('Read-Users');
        $user = User::findOrFail($slug);
        return view('dashboard.user.show', ['user' => $user]);
    }

    public function getData(Request $request)
    {
        $this->authorize('Read-Users');
        $type = $request->input('type');
        $userId = $request->input('user_id');
        $perPage = $request->input('per_page', 10);
        $query = $request->input('query');

        $user = User::find($userId);
        // dd($user->wallet->transactions);
        switch ($type) {
            case 'followers':
                $data = $user->followers()->where('name', 'like', '%' . $query . '%')->paginate($perPage);
                return view('dashboard.user.table.user', ['users' => $data]);
            case 'following':
                $data = $user->following()->where('name', 'like', '%' . $query . '%')->paginate($perPage);
                return view('dashboard.user.table.user', ['users' => $data]);
            case 'wallets':
                $data = $user->wallet->transactions()->paginate($perPage);
                return view('dashboard.user.table.wallet', ['contacts' => $data]);
            case 'products':
                $data = $user->matjarProducts()->paginate($perPage);
                return view('dashboard.user.table.products', ['contacts' => $data]);
            case 'rooms':
                $data = $user->rooms()->where('name', 'like', '%' . $query . '%')->paginate($perPage);
                return view('dashboard.user.table.room', ['contacts' => $data]);
            default:
                return response()->json(['error' => 'Invalid type'], 400);
        }
    }


    /**
     * change user status
     */
    public function changeStatus(Request $request)
    {
        $this->authorize('Update-User-Status');
        $user = User::findOrFail($request->id);

        $user->status = !$user->status;

        $isSaved = $user->save();

        $message = $isSaved ? __('site.saved_successfully') : __('site.failed_to_save');

        return response()->json(['message' => $message], $isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }
}
