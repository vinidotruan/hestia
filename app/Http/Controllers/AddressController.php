<?php

namespace App\Http\Controllers;

use App\Http\Requests\Address\StoreAddressRequest;
use App\Http\Requests\Address\UpdateAddressRequest;
use App\Models\Address;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return response()->json(['data' => Auth::user()->address()->get()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAddressRequest $request): JsonResponse
    {
        $response = Address::create($request->all());
        return response()->json(['data' => $response]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Address $address): JsonResponse
    {
        return response()->json(['data' => $address]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAddressRequest $request, Address $address): JsonResponse
    {
        if ($request->user()->cannot('update', $address)) {
            return response()->json(['message' => 'Not allowed'], 403);
        }
        $response = $address->update($request->all());
        return response()->json(['data' => $response]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Address $address): JsonResponse
    {
        if ($request->user()->cannot('update', $address)) {
            return response()->json(['message' => 'Not allowed'], 403);
        }
        $address->delete();
        return response()->json(['data' => 'deleted']);
    }
}
