<?php

namespace App\Http\Controllers;

use App\Http\Requests\SettingsRequest;
use App\Models\Conversion;
use App\Models\Percentage;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SettingsController extends Controller
{
    public function create()
    {
        return view('dashboard.settings.create');
    }

    public function store(SettingsRequest $request)
    {
        $this->changeStatusSettings();

        $validatedData = $request->validated();

        $precentage = Percentage::create($validatedData);

        $types = ['diamonds', 'silver', 'gold'];


        foreach ($types as $type) {
            Conversion::create([
                'type' => $validatedData["type_{$type}"],
                'quantity' => $validatedData["quantity_{$type}"],
                'dollar' => $validatedData["dollar_{$type}"],
                'status' => 1,
            ]);
        }

        return response()->json(['message' => __('site.create_successfully')], Response::HTTP_CREATED);
    }

    private function changeStatusSettings()
    {
        Percentage::where('status', 1)->update(['status' => 0]);
        Conversion::where('status', 1)->update(['status' => 0]);
    }
}
