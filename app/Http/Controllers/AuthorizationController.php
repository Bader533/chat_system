<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AuthorizationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function Rules()
    {
        return view('dashboard.rule.index');
    }

    /**
     * get all rules to show it using js
     */
    public function getRules(Request $request)
    {
        $query = $request->input('query');
        $perPage = $request->input('per_page', 10);
        $data = Role::query();

        if ($query == null) {
            $contacts = $data->paginate($perPage);
        } else {
            $contacts = $data->where('name', 'like', '%' . $query . '%')
                ->paginate($perPage);
        }

        return view('dashboard.rule.rule', ['contacts' => $contacts]);
    }

    /**
     * Display a listing of the resource.
     */
    public function Permissions()
    {
        return view('dashboard.permission.index');
    }

    /**
     * get all rules to show it using js
     */
    public function getPermissions(Request $request)
    {
        $query = $request->input('query');
        $perPage = $request->input('per_page', 10);
        $data = Permission::query();

        if ($query == null) {
            $contacts = $data->paginate($perPage);
        } else {
            $contacts = $data->where('name', 'like', '%' . $query . '%')
                ->paginate($perPage);
        }

        return view('dashboard.permission.permission', ['contacts' => $contacts]);
    }
}
