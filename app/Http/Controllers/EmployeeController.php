<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\Response;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('Read-Employees');
        return view('dashboard.employee.index');
    }

    /**
     * get all user employee to show it using js
     */
    public function getEmplyees(Request $request)
    {
        $this->authorize('Read-Employees');
        // Retrieve input values with sensible defaults
        $query = $request->input('query');
        $perPage = $request->input('per_page', 10);

        // Start building the query
        $data = User::isEmployee();

        // Filter by search query if provided
        if (!empty($query)) {
            $data->where('name', 'like', '%' . $query . '%');
        }

        // Paginate the results
        $contacts = $data->paginate($perPage);

        // Return the view with the data
        return view('dashboard.employee.employee', ['contacts' => $contacts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('Create-Employee');

        $roles = Role::get();
        return view('dashboard.employee.create', ['roles' => $roles]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeRequest $request)
    {
        $this->authorize('Create-Employee');

        $validatedData = $request->validated();

        $data = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['email']),
            'type' => $validatedData['type'],
            'status' => $validatedData['status'],
        ]);

        // Convert the comma-separated string of role IDs to an array
        $roleIds = explode(',', $request->input('role'));

        // Attach roles to the user
        $data->roles()->sync($roleIds);

        return response()->json(['message' => __('site.create_successfully')], Response::HTTP_CREATED);
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
    public function edit($id)
    {
        $this->authorize('Update-Employee');
        $roles = Role::get();
        $employee = User::isEmployee()->findOrFail($id);
        // dd($employee->roles);
        return view('dashboard.employee.edit', ['roles' => $roles, 'employee' => $employee]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmployeeRequest $request, $id)
    {
        $this->authorize('Update-Employee');

        $employee = User::isEmployee()->findOrFail($id);
        $validatedData = $request->validated();

        // Filter out null or empty fields
        $filteredData = array_filter($validatedData, function ($value) {
            return $value !== null && $value !== ''; // Filter out null and empty values
        });

        // Hash password only if it's in the filtered data
        if (isset($filteredData['password'])) {
            $filteredData['password'] = Hash::make($filteredData['password']);
        }

        $employee->update($filteredData);

        // Convert the comma-separated string of role IDs to an array
        $roleIds = explode(',', $request->input('role'));

        // Sync roles with the user
        $employee->roles()->sync($roleIds);

        return response()->json(['message' => __('site.update_successfully')], Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }

    /**
     * change room status
     */
    public function changeStatus(Request $request)
    {
        $this->authorize('Read-Employees');

        $employee = User::isEmployee()->findOrFail($request->id);

        $employee->status = !$employee->status;

        $isSaved = $employee->save();

        $message = $isSaved ? __('site.saved_successfully') : __('site.failed_to_save');

        return response()->json(['message' => $message], $isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }
}
