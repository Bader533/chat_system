<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.employee.index');
    }

    /**
     * get all user employee to show it using js
     */
    public function getEmplyees(Request $request)
    {
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
        return view('dashboard.employee.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeRequest $request)
    {
        $validatedData = $request->validated();
        $data = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['email']),
            'type' => $validatedData['type'],
            'status' => $validatedData['status'],
        ]);
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
        $employee = User::isEmployee()->findOrFail($id);
        return view('dashboard.employee.edit', ['employee' => $employee]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmployeeRequest $request, $id)
    {
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
        $employee = User::isEmployee()->findOrFail($request->id);

        $employee->status = !$employee->status;

        $isSaved = $employee->save();

        $message = $isSaved ? __('site.saved_successfully') : __('site.failed_to_save');

        return response()->json(['message' => $message], $isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }
}
