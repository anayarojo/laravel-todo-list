<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;

class UserRoleController extends Controller
{
    public function add(Request $request, User $user, Role $role)
    {
        $userRole = UserRole::whereDeleted(false)->whereUserId($user->id)->whereRoleId($role->id)->first();

        if (!$userRole)
        {
            $userRole = UserRole::create([
                'user_id' => $user->id,
                'role_id' => $role->id
            ]);
        }

        return response()->json([
            'success' => true,
            'data' => $userRole
        ]);
    }

    public function quit(Request $request, User $user, Role $role)
    {
        $userRole = UserRole::whereDeleted(false)->whereUserId($user->id)->whereRoleId($role->id)->first();

        if ($userRole)
        {
            $userRole->deleted = true;
            $userRole->save();
        }

        return response()->json([
            'success' => true
        ]);
    }
}
