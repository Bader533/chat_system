<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.post.index');
    }

    /**
     * get all posts to show it using js
     */
    public function getPost(Request $request)
    {
        // Retrieve input values with sensible defaults
        $query = $request->input('query');
        $perPage = $request->input('per_page', 10);

        // Start building the query
        $eventsQuery = Post::query();

        // Filter by search query if provided
        if (!empty($query)) {
            $eventsQuery->where('title', 'like', '%' . $query . '%');
        }

        // Paginate the results
        $contacts = $eventsQuery->paginate($perPage);

        // Return the view with the data
        return view('dashboard.post.post', ['contacts' => $contacts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.post.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['user_id'] = 1;
        $data = Post::create($validatedData);
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
        $post = Post::where('slug', $slug)->firstOrFail();
        return view('dashboard.post.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, $slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        $validatedData = $request->validated();
        $validatedData['user_id'] = 1;
        $post->update($validatedData);
        $post->updateAvatar($request);
        return response()->json(['message' => __('site.update_successfully')], Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slug)
    {
        $event = Post::where('slug', $slug)->firstOrFail();
        $event->delete();
        return response()->json(['message' => __('site.delete_successfully')], Response::HTTP_CREATED);
    }

    /**
     * change post status
     */
    public function changeStatus(Request $request)
    {
        $post = Post::findOrFail($request->id);

        $post->status = !$post->status;

        $isSaved = $post->save();

        $message = $isSaved ? __('site.saved_successfully') : __('site.failed_to_save');

        return response()->json(['message' => $message], $isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }
}
