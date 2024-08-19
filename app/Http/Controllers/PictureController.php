<?php

namespace App\Http\Controllers;

use App\Http\Requests\Pictures\StorePictureRequest;
use App\Models\Picture;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class PictureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
       return response()->json(['data' => auth()->user()->pictures]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePictureRequest $request): JsonResponse
    {
        $oldMain = auth()->user()->pictures()->where('main', 1)->first();
        $image = $request->file('image');
        $path = Storage::disk('public')->putFileAs('pictures/users/'.auth()->user()->id, $image, $image->getClientOriginalName());
        $data = [
            ...$request->all(),
            'url' => asset('storage/'.$path),
            'name' => $path
        ];
        if($request->get('main') && isset($oldMain)) {
            $oldMain->update(['main' => false]);
        }
        $picture = Picture::create($data);
        return response()->json($picture);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Picture $picture)
    {
        if(!Gate::allows('delete-picture', $picture)) {
            return response()->json(['message' => 'not allowed', 401]);
        }
        $picture->delete();
        return response()->json(['data' => 'Deleted']);
    }
}
