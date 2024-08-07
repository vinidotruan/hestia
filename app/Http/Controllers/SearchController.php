<?php

namespace App\Http\Controllers;

use App\Helpers\DistanceHelper;
use App\Http\Requests\Search\SearchOngsRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class SearchController extends Controller
{
    public function searchOngsByDistance(SearchOngsRequest $request): JsonResponse
    {
        $users = User::role("ong")->with('address')->get();
        $distance = $request->get('distance');
        $lonDestiny = $request->get('lon');
        $latDestiny = $request->get('lat');
        $closer = [];

        foreach ($users as $user) {
            $a = $user->address;
            $d = DistanceHelper::distance(
                    $a->lat,
                    $a->lon,
                    $latDestiny,
                    $lonDestiny
                ) / 1000;
            if ($d < $distance) {
                $closer[] = $user;
            }
        }

        return response()->json(['data' => $closer]);
    }
}
