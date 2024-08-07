<?php

namespace App\Http\Controllers;

use App\Http\Requests\Users\AccessRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class AdminController extends Controller
{
    public function authorizeUser(AccessRequest $request): JsonResponse
    {
        $targetUser = User::find($request->get('target_user'));
        $targetUser->update(['active' => $request->get('active')]);
        if($request->get('role')) {
            $targetUser->assignRole($request->get('role'));
        }

        return response()->json(['data' => 'Success']);
    }
}
