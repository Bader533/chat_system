<?php

namespace App\Http\Controllers;

use App\Http\Requests\MatjarCategoryRequest;
use App\Models\MatjarCategory;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MatjarCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $this->authorize('Read-Posts');

        return view('dashboard.matjar-category.index');
    }

    /**
     * get all posts to show it using js
     */
    public function getCategories(Request $request)
    {
        // $this->authorize('Read-Posts');

        // Retrieve input values with sensible defaults
        $query = $request->input('query');
        $perPage = $request->input('per_page', 10);

        // Start building the query
        $eventsQuery = MatjarCategory::query();

        // Filter by search query if provided
        if (!empty($query)) {
            $eventsQuery->where('name_en', 'like', '%' . $query . '%')
                ->orWhere('name_ar', 'like', '%' . $query . '%');
        }

        // Paginate the results
        $contacts = $eventsQuery->paginate($perPage);

        // Return the view with the data
        return view('dashboard.matjar-category.categories', ['contacts' => $contacts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $this->authorize('Create-Post');

        return view('dashboard.matjar-category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MatjarCategoryRequest $request)
    {
        // $this->authorize('Create-Post');

        $validatedData = $request->validated();
        $validatedData['user_id'] = 1;
        $data = MatjarCategory::create($validatedData);
        $data->updateAvatar($request);
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
        // $this->authorize('Update-Post');

        $category = MatjarCategory::where('slug', $slug)->firstOrFail();
        return view('dashboard.matjar-category.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(matjarCategoryRequest $request, $slug)
    {
        // $this->authorize('Update-Post');

        $category = MatjarCategory::where('slug', $slug)->firstOrFail();
        $validatedData = $request->validated();
        $category->update($validatedData);
        $category->updateAvatar($request);
        return response()->json(['message' => __('site.update_successfully')], Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slug)
    {
        // $this->authorize('Delete-Post');

        $category = MatjarCategory::where('slug', $slug)->firstOrFail();
        $category->delete();
        return response()->json(['message' => __('site.delete_successfully')], Response::HTTP_CREATED);
    }
}
