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
        $this->authorize('Read-Adses');

        return view('dashboard.ads.index');
    }

    public function getAds(Request $request)
    {
        $this->authorize('Read-Adses');

        $query = $request->input('query');
        $perPage = $request->input('per_page', 5);
        $data = Ads::query();

        if ($query == null) {
            $ads = $data->paginate($perPage);
        } else {
            $ads = $data->where('name_en', 'like', '%' . $query . '%')
                ->where('name_ar', 'like', '%' . $query . '%')
                ->paginate($perPage);
        }

        return view('dashboard.ads.ads', ['ads' => $ads]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('Create-Ads');

        return view('dashboard.ads.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdsRequest $request)
    {
        $this->authorize('Create-Ads');
        $ads = Ads::create([
            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,
            'description_en' => $request->description_en,
            'description_ar' => $request->description_ar,
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
        $this->authorize('Update-Ads');
        $ads = Ads::where('slug', $slug)->firstOrFail();
        return view('dashboard.ads.edit', ['ads' => $ads]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdsRequest $request, $slug)
    {
        $this->authorize('Update-Ads');

        $ads = Ads::where('slug', $slug)->firstOrFail();

        $ads->update([
            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,
            'description_en' => $request->description_en,
            'description_ar' => $request->description_ar,
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
        $this->authorize('Delete-Ads');

        $ads = Ads::where('slug', $slug)->firstOrFail();
        $deleted = $ads->delete();
        return response()->json(['message' => __('site.delete_successfully')], Response::HTTP_CREATED);
    }
}
