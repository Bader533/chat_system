<?php

namespace App\Http\Controllers;

use App\Http\Requests\LevelRequest;
use App\Models\Level;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LevelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $this->authorize('Read-Cities');

        return view('dashboard.level.index');
    }

    /**
     * get all levels to show it using js
     */
    public function getLevels(Request $request)
    {
        // $this->authorize('Read-Cities');

        $query = $request->input('query');
        $perPage = $request->input('per_page', 10);
        $data = Level::query();

        if ($query == null) {
            $contacts = $data->paginate($perPage);
        } else {
            $contacts = $data->where('name_en', 'like', '%' . $query . '%')
                ->orWhere('name_ar', 'like', '%' . $query . '%')
                ->paginate($perPage);
        }

        return view('dashboard.level.levels', ['contacts' => $contacts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $this->authorize('Create-City');

        return view('dashboard.level.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LevelRequest $request)
    {
        // $this->authorize('Create-City');

        $validatedData = $request->validated();
        $level = Level::create($validatedData);
        $level->updateAvatar($request);
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
        // $this->authorize('Update-City');

        $level = Level::whereSlug($slug)->firstOrFail();
        return view('dashboard.level.edit', ['level' => $level]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LevelRequest $request, $slug)
    {
        // $this->authorize('Update-City');

        $level = Level::whereSlug($slug)->firstOrFail();
        $validatedData = $request->validated();
        $level->update($validatedData);
        $level->updateAvatar($request);
        return response()->json(['message' => __('site.update_successfully')], Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slug)
    {
        // $this->authorize('Read-Cities');

        $level = Level::whereSlug($slug)->firstOrFail();
        $level->delete();
        return response()->json(['message' => __('site.delete_successfully')], Response::HTTP_CREATED);
    }
}
