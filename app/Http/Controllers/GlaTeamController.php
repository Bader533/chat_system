<?php

namespace App\Http\Controllers;

use App\Http\Requests\GlaTeamRequest;
use App\Models\GlaTeam;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GlaTeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.gla-team.index');
    }

    /**
     * get all gla teams to show it using js
     */
    public function getTeams(Request $request)
    {
        // Retrieve input values with sensible defaults
        $query = $request->input('query');
        $perPage = $request->input('per_page', 10);

        // Start building the query
        $teamsQuery = GlaTeam::query();

        // Filter by search query if provided
        if (!empty($query)) {
            $teamsQuery->where('title', 'like', '%' . $query . '%');
        }

        // Paginate the results
        $contacts = $teamsQuery->paginate($perPage);

        // Return the view with the data
        return view('dashboard.gla-team.team', ['contacts' => $contacts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.gla-team.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GlaTeamRequest $request)
    {
        $validatedData = $request->validated();
        $team = GlaTeam::create($validatedData);
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
    public function edit($slug)
    {
        $team = GlaTeam::where('slug', $slug)->firstOrFail();
        return view('dashboard.gla-team.edit', ['team' => $team]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GlaTeamRequest $request, $slug)
    {
        $team = GlaTeam::where('slug', $slug)->firstOrFail();
        $validatedData = $request->validated();
        $team->update($validatedData);
        return response()->json(['message' => __('site.update_successfully')], Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slug)
    {
        $team = GlaTeam::where('slug', $slug)->firstOrFail();
        $team->delete();
        return response()->json(['message' => __('site.delete_successfully')], Response::HTTP_CREATED);
    }

    /**
     * change room status
     */
    public function changeStatus(Request $request)
    {
        $team = GlaTeam::findOrFail($request->id);

        $team->status = !$team->status;

        $isSaved = $team->save();

        $message = $isSaved ? __('site.saved_successfully') : __('site.failed_to_save');

        return response()->json(['message' => $message], $isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }
}
