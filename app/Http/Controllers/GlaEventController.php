<?php

namespace App\Http\Controllers;

use App\Http\Requests\GlaEventRequest;
use App\Models\GlaEvent;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GlaEventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('Read-Events');
        return view('dashboard.gla-event.index');
    }

    /**
     * get all countries to show it using js
     */
    public function getEvents(Request $request)
    {
        $this->authorize('Read-Events');
        // Retrieve input values with sensible defaults
        $query = $request->input('query');
        $perPage = $request->input('per_page', 10);

        // Start building the query
        $eventsQuery = GlaEvent::query();

        // Filter by search query if provided
        if (!empty($query)) {
            $eventsQuery->where('title_en', 'like', '%' . $query . '%')
                ->orWhere('title_ar', 'like', '%' . $query . '%');
        }

        // Paginate the results
        $contacts = $eventsQuery->paginate($perPage);

        // Return the view with the data
        return view('dashboard.gla-event.event', ['contacts' => $contacts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('Create-Event');
        return view('dashboard.gla-event.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GlaEventRequest $request)
    {
        $this->authorize('Create-Event');
        $validatedData = $request->validated();
        $event = GlaEvent::create($validatedData);
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
        $this->authorize('Update-Event');
        $event = GlaEvent::where('slug', $slug)->firstOrFail();
        return view('dashboard.gla-event.edit', ['event' => $event]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GlaEventRequest $request, $slug)
    {
        $this->authorize('Update-Event');
        $event = GlaEvent::where('slug', $slug)->firstOrFail();
        $validatedData = $request->validated();
        $event->update($validatedData);
        return response()->json(['message' => __('site.update_successfully')], Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slug)
    {
        $this->authorize('Read-Events');
        $event = GlaEvent::where('slug', $slug)->firstOrFail();
        $event->delete();
        return response()->json(['message' => __('site.delete_successfully')], Response::HTTP_CREATED);
    }

    /**
     * change room status
     */
    public function changeStatus(Request $request)
    {
        $this->authorize('Read-Events');
        $event = GlaEvent::findOrFail($request->id);

        $event->status = !$event->status;

        $isSaved = $event->save();

        $message = $isSaved ? __('site.saved_successfully') : __('site.failed_to_save');

        return response()->json(['message' => $message], $isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }
}
