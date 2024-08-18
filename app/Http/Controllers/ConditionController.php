<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConditionRequest;
use App\Models\Condition;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ConditionController extends Controller
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
        $condition = Condition::first();
        return view('dashboard.condition.create', ['condition' => $condition]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ConditionRequest $request)
    {
        $condition = Condition::first();

        if (!$condition) {
            $created = Condition::create($request->all());
        } else {
            $updated = $condition->update($request->all());
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
