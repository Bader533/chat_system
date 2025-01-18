<?php

namespace App\Http\Controllers;

use App\Http\Requests\AgencyHostRequest;
use App\Models\AgencyHost;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AgencyHostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $this->authorize('Read-Egencies');
        return view('dashboard.agency-hosts.index');
    }

    /**
     * get all countries to show it using js
     */
    public function getAgencyHosts(Request $request)
    {
        $this->authorize('Read-Egencies');

        $query = $request->input('query');
        $perPage = $request->input('per_page', 10);
        $data = AgencyHost::query();

        if ($query == null) {
            $contacts = $data->paginate($perPage);
        } else {

            $contacts = $data->whereHas('user', function ($obj) use ($query) {
                $obj->where('name', 'like', '%' . $query . '%');
            })->paginate($perPage);
        }

        return view('dashboard.agency-hosts.agency', ['contacts' => $contacts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $this->authorize('Create-Egency');
        $users = User::where('type', 2)->select(['id', 'name'])->get();
        return view('dashboard.agency-hosts.create', ['users' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AgencyHostRequest $request)
    {
        // $this->authorize('Create-Egency');
        $existingUser = AgencyHost::where('user_id', $request->user_id)->first();

        if ($existingUser) {
            return response()->json(['message' => __('site.user_already_exists')], Response::HTTP_CONFLICT);
        }

        $task = Task::orderBy('id', 'asc')->first();
        $validatedData = $request->validated();
        $validatedData['task_id'] = $task->id;

        $agencyHost = AgencyHost::create($validatedData);
        return response()->json(['message' => __('site.create_successfully')], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // $this->authorize('Show-Egency');
        $agency = AgencyHost::findOrFail($id);
        return view('dashboard.agency-hosts.show', ['agency' => $agency]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // $this->authorize('Update-Egency');
        $users = User::where('type', 2)->select(['id', 'name'])->get();

        $agency = AgencyHost::findOrFail($id);
        return view('dashboard.agency-hosts.edit', ['agency' => $agency, 'users' => $users]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AgencyHostRequest $request, $id)
    {
        // $this->authorize('Update-Egency');
        $agency = AgencyHost::findOrFail($id);
        $validatedData = $request->validated();
        $agency->update($validatedData);

        return response()->json(['message' => __('site.update_successfully')], Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AgencyHost $agency)
    {
        //
    }
}
