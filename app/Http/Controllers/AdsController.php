<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdsRequest;
use App\Models\Ads;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;

class AdsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.ads.index');
    }

    public function getAds(Request $request)
    {
        $query = $request->input('query');
        $perPage = $request->input('per_page', 5);
        $data = Ads::query();

        if ($query == null) {
            $ads = $data->paginate($perPage);
        } else {
            $ads = $data->where('name', 'like', '%' . $query . '%')
                ->paginate($perPage);
        }

        return view('dashboard.ads.ads', ['ads' => $ads]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.ads.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdsRequest $request)
    {
        $ads = Ads::create([
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status,
            'is_home' => $request->is_home
        ]);

        $ads->updateAvatar($request);

        return response()->json(['message' => __('site.create_successfully')], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {
        $ads = Ads::where('slug', $slug)->firstOrFail();
        return view('dashboard.ads.edit', ['ads' => $ads]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdsRequest $request, $slug)
    {
        $ads = Ads::where('slug', $slug)->firstOrFail();

        $ads->update([
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status,
            'is_home' => $request->is_home
        ]);

        $ads->updateAvatar($request);

        return response()->json(['message' => __('site.update_successfully')], Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slug)
    {
        $ads = Ads::where('slug', $slug)->firstOrFail();
        // dd($ads);
        $deleted = $ads->delete();
        return response()->json(['message' => __('site.delete_successfully')], Response::HTTP_CREATED);
    }
}
