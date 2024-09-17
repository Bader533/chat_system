<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('Read-Groups');
        return view('dashboard.group.index');
    }

    /**
     * get all groups to show it using js
     */
    public function getGroups(Request $request)
    {
        $this->authorize('Read-Groups');
        // Retrieve input values with sensible defaults
        $query = $request->input('query');
        $perPage = $request->input('per_page', 10);

        // Start building the query
        $groupsQuery = Group::query();

        // Filter by search query if provided
        if (!empty($query)) {
            $groupsQuery->where('name', 'like', '%' . $query . '%');
        }

        // Paginate the results
        $contacts = $groupsQuery->paginate($perPage);

        // Return the view with the data
        return view('dashboard.group.group', ['contacts' => $contacts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Group $group)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Group $group)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Group $group)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Group $group)
    {
        //
    }

    /**
     * change group status
     */
    public function changeStatus(Request $request)
    {
        $this->authorize('Update-Group-Status');

        $group = Group::findOrFail($request->id);

        $group->status = !$group->status;

        $isSaved = $group->save();

        $message = $isSaved ? __('site.saved_successfully') : __('site.failed_to_save');

        return response()->json(['message' => $message], $isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }
}
