<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class ListController extends Controller
{
    public function index(Group $category = null)
    {
        $lists = $category != null ?
            $category->lists :
            JWTAuth::user()->lists;

        return response()->json([
            'success' => true,
            'data' => $lists
        ]);
    }

    public function store(Request $request, Group $category = null)
    {
        $list = $category != null ?
            $category->lists()->create($request->all()) :
            JWTAuth::user()->lists()->create($request->all());

        return response()->json([
            'success' => true,
            'data' => $list
        ]);
    }

    public function show(Group $list)
    {
        return response()->json([
            'success' => true,
            'data' => $list
        ]);
    }

    public function update(Request $request, Group $list)
    {
        $list->update($request->all());

        return response()->json([
            'success' => true,
            'data' => $list
        ]);
    }

    public function destroy(Group $list)
    {
        $list->deleted = true;
        $list->save();

        return response()->json([
            'success' => true
        ]);
    }
}
