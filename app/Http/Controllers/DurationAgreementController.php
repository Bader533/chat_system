<?php

namespace App\Http\Controllers;

use App\Http\Requests\DurationAgreementRequest;
use App\Models\DurationAgreement;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DurationAgreementController extends Controller
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
        $duration = DurationAgreement::first();
        return view('dashboard.duration-agreement.create', ['duration' => $duration]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DurationAgreementRequest $request)
    {
        $duration = DurationAgreement::first();

        if (!$duration) {
            $created = DurationAgreement::create($request->all());
        } else {
            $updated = $duration->update($request->all());
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
