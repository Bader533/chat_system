<?php

namespace App\Http\Controllers;

use App\Http\Requests\WalletRequest;
use App\Models\Conversion;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WalletController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($data = null)
    {
        return view('dashboard.wallet.index');
    }

    /**
     * get all countries to show it using js
     */
    public function getWallets(Request $request)
    {
        // Retrieve input values with sensible defaults
        $query = $request->input('query');
        $perPage = $request->input('per_page', 10);
        $kind = $request->input('kind');

        // Start building the query
        $data = Wallet::query();

        // Filter by search query if provided
        if (!empty($query)) {
            $data->where(function ($q) use ($query) {
                $q->searchUser($query)->orWhereHas('agency', function ($q) use ($query) {
                    $q->where('name', 'like', '%' . $query . '%');
                });
            });
        }

        // Paginate the results
        $contacts = $data->paginate($perPage);

        // Return the view with the data
        return view('dashboard.wallet.wallet', ['contacts' => $contacts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.wallet.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(WalletRequest $request)
    {
        $user = User::findOrFail($request->user_id);
        $validatedData = $request->validated();
        $validatedData['user_id'] = $user->id;
        $validatedData['agency_id'] = 1;
        $validatedData['dollar'] = $this->calculate($validatedData['type'], $validatedData['quantity']);
        $data = Wallet::create($validatedData);
        return response()->json(['message' => __('site.create_successfully')], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $data = Wallet::where('slug', $slug)->firstOrFail();
        return view('dashboard.wallet.show', ['data' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(WalletRequest $request, $slug)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slug)
    {
        //
    }

    private function calculate($type, $quantity)
    {
        $conversion = Conversion::isActive()->where('type', $type)->first();
        $dollarAmount = ($quantity / $conversion->quantity) * $conversion->dollar;
        return $dollarAmount;
    }
}
