<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('dashboard.user.index');
    }

    public function getUser(Request $request)
    {
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
}
