<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('Read-Tasks');

        return view('dashboard.task.index');
    }

    /**
     * get all tasks to show it using js
     */
    public function getTesks(Request $request)
    {
        $this->authorize('Read-Tasks');

        $query = $request->input('query');
        $perPage = $request->input('per_page', 10);
        $data = Task::query();

        if ($query == null) {
            $contacts = $data->paginate($perPage);
        } else {
            $contacts = $data->where('name_en', 'like', '%' . $query . '%')
                ->orWhere('name_ar', 'like', '%' . $query . '%')
                ->paginate($perPage);
        }

        return view('dashboard.task.tasks', ['contacts' => $contacts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('Create-Task');

        return view('dashboard.task.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request)
    {
        $this->authorize('Create-Task');

        $validatedData = $request->validated();
        $task = Task::create($validatedData);
        $task->updateAvatar($request);
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
        $this->authorize('Update-Task');

        $task = Task::whereSlug($slug)->firstOrFail();
        return view('dashboard.task.edit', ['task' => $task]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskRequest $request, $slug)
    {
        $this->authorize('Update-Task');

        $task = Task::whereSlug($slug)->firstOrFail();
        $validatedData = $request->validated();
        $task->update($validatedData);
        $task->updateAvatar($request);
        return response()->json(['message' => __('site.update_successfully')], Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slug)
    {
        $this->authorize('Read-Task');

        $task = Task::whereSlug($slug)->firstOrFail();
        $task->delete();
        return response()->json(['message' => __('site.delete_successfully')], Response::HTTP_CREATED);
    }
}
