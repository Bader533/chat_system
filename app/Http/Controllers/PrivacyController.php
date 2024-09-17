<?php

namespace App\Http\Controllers;

use App\Http\Requests\PrivacyRequest;
use App\Models\Privacy;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PrivacyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('Create-Privacy');

        $privacy = Privacy::first();
        return view('dashboard.privacy.create', ['privacy' => $privacy]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PrivacyRequest $request)
    {
        $this->authorize('Create-Privacy');

        $privacy = Privacy::first();

        if (!$privacy) {
            $created = Privacy::create($request->all());
        } else {
            $updated = $privacy->update($request->all());
        }

        return response()->json(['message' => __('site.done_successfully')], Response::HTTP_CREATED);
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
