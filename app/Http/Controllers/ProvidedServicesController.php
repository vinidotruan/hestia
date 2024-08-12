<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProvidedService\StoreProvidedServiceRequest;
use App\Http\Requests\ProvidedService\UpdateProvidedServiceRequest;
use App\Models\ProvidedServices;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProvidedServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $data = Auth::user()->providedServices()->get();
        return response()->json(['data' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProvidedServiceRequest $request): JsonResponse
    {
        if ($request->user()->cannot('create', ProvidedServices::class)) {
            return response()->json(['message' => 'Not allowed'], 403);
        }
        $providedService = ProvidedServices::create($request->all());
        return response()->json(['data' => $providedService]);
    }

    /**
     * Display the specified resource.
     */
    public function show(ProvidedServices $providedServices): JsonResponse
    {
        return response()->json(['data' => $providedServices]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProvidedServiceRequest $request, string $providedServices): JsonResponse
    {
        $model = ProvidedServices::find($providedServices);
        if ($request->user()->cannot('update', $model)) {
            return response()->json(['message' => 'Not allowed'], 403);
        }
        $model->update($request->all());
        return response()->json(['data' => $model]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, ProvidedServices $providedServices): JsonResponse
    {
        if ($request->user()->cannot('delete', $providedServices)) {
            return response()->json(['message' => 'Not allowed'], 403);
        }
        $providedServices->delete();
        return response()->json(['data' => 'Deleted']);
    }
}
