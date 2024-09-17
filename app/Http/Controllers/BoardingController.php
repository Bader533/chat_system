<?php

namespace App\Http\Controllers;

use App\Http\Requests\BoardingRequest;
use App\Models\Boarding;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BoardingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('Read-Boardings');
        $boardings = Boarding::paginate(10);
        return view('dashboard.boarding.index', ['boardings' => $boardings]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('Create-Employee');

        return view('dashboard.boarding.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BoardingRequest $request)
    {
        $this->authorize('Create-Employee');

        $boarding = Boarding::create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'place' => $request->place
        ]);
        return response()->json(['message' => __('site.create_boarding_successfully')], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $this->authorize('Read-Boardings');

        $boarding = Boarding::findOrFail($id);
        return view('dashboard.boarding.show', ['boarding' => $boarding]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $this->authorize('Update-Employee');

        $boarding = Boarding::findOrFail($id);
        return view('dashboard.boarding.edit', ['boarding' => $boarding]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BoardingRequest $request, $id)
    {
        $this->authorize('Update-Employee');

        $boarding = Boarding::findOrFail($id);

        $updated = $boarding->update([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'place' => $request->place
        ]);
        return response()->json(['message' => __('site.update_boarding_successfully')], Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->authorize('Read-Boardings');

        $boarding = Boarding::findOrFail($id);
        $deleted = $boarding->delete();
        return response()->json(['message' => __('site.delete_boarding_successfully')], Response::HTTP_CREATED);
    }

    public function search(Request $request)
    {
        $this->authorize('Read-Boardings');

        $query = $request->get('search');
        $boardings = Boarding::where('title', 'like', '%' . $query . '%')
            ->orderBy('id', 'desc')->get();
        return view('dashboard.boarding.search', ['boardings' => $boardings]);
    }
}
