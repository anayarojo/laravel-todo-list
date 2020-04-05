<?php

namespace App\Http\Controllers;

use App\Models\User;

class ValidatorController extends Controller
{
    function isEmailAvailable($email) {

        $isAvailable = User::whereDeleted(false)->whereEmail($email)->count() == 0;

        return response()->json([
            'success'   => true,
            'available' => $isAvailable
        ]);
    }
}
