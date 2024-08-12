<?php

namespace App\Http\Controllers;

use App\Http\Requests\Contacts\StoreContactsRequest;
use App\Http\Requests\Contacts\UpdateContactsRequest;
use App\Models\Contacts;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $data = Auth::user()->contacts()->get();
        return response()->json(['data' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreContactsRequest $request): JsonResponse
    {
        if ($request->user()->cannot('create', [Contacts::class, $request->user_id])) {
            return response()->json(['message' => 'Not Allowed'], 403);
        }

        $contact = Contacts::create($request->all());
        return response()->json(['data' => $contact]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Contacts $contacts): JsonResponse
    {
        return response()->json(['data' => $contacts]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateContactsRequest $request, string $contacts): JsonResponse
    {
        $model = Contacts::find($contacts);
        if ($request->user()->cannot('update', $model)) {
            return response()->json(['message' => 'Not allowed'], 403);
        }
        $model->update($request->all());
        return response()->json(['data' => $model]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Contacts $contacts): JsonResponse
    {
        if ($request->user()->cannot('delete', $contacts)) {
            return response()->json(['message' => 'Not allowed'], 403);
        }
        $contacts->delete();
        return response()->json(['data' => 'Deleted']);
    }
}
