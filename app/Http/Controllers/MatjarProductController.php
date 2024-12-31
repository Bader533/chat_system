<?php

namespace App\Http\Controllers;

use App\Http\Requests\MatjarProductRequest;
use App\Models\MatjarCategory;
use App\Models\MatjarProduct;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MatjarProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $this->authorize('Read-Posts');

        return view('dashboard.matjar-product.index');
    }

    /**
     * get all posts to show it using js
     */
    public function getProducts(Request $request)
    {
        // $this->authorize('Read-Posts');

        // Retrieve input values with sensible defaults
        $query = $request->input('query');
        $perPage = $request->input('per_page', 10);

        // Start building the query
        $eventsQuery = MatjarProduct::query();

        // Filter by search query if provided
        if (!empty($query)) {
            $eventsQuery->where('name_en', 'like', '%' . $query . '%')
                ->orWhere('name_ar', 'like', '%' . $query . '%');
        }

        // Paginate the results
        $contacts = $eventsQuery->paginate($perPage);

        // Return the view with the data
        return view('dashboard.matjar-product.products', ['contacts' => $contacts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $this->authorize('Create-Post');
        $categories = MatjarCategory::select('id', 'name_ar')->get();
        return view('dashboard.matjar-product.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MatjarProductRequest $request)
    {
        // $this->authorize('Create-Post');

        $validatedData = $request->validated();
        $validatedData['user_id'] = 1;
        $data = MatjarProduct::create($validatedData);
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

        $product = MatjarProduct::where('slug', $slug)->firstOrFail();
        $categories = MatjarCategory::select('id', 'name_ar')->get();
        return view('dashboard.matjar-product.edit', [
            'product' => $product,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MatjarProductRequest $request, $slug)
    {
        // $this->authorize('Update-Post');

        $product = MatjarProduct::where('slug', $slug)->firstOrFail();
        $validatedData = $request->validated();
        $product->update($validatedData);
        $product->updateAvatar($request);
        return response()->json(['message' => __('site.update_successfully')], Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slug)
    {
        // $this->authorize('Delete-Post');

        $product = MatjarProduct::where('slug', $slug)->firstOrFail();
        $product->delete();
        return response()->json(['message' => __('site.delete_successfully')], Response::HTTP_CREATED);
    }
}
