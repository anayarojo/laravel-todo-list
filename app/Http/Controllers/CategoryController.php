<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = JWTAuth::user()->categories;

        return response()->json([
            'success' => true,
            'data' => $categories
        ]);
    }

    public function store(Request $request)
    {
        $category = JWTAuth::user()->categories()->create($request->all());

        return response()->json([
            'success' => true,
            'data' => $category
        ]);
    }

    public function show(Group $category)
    {
        return response()->json([
            'success' => true,
            'data' => $category
        ]);
    }

    public function update(Request $request, Group $category)
    {
        $category->update($request->all());

        return response()->json([
            'success' => true,
            'data' => $category
        ]);
    }

    public function destroy(Group $category)
    {
        $category->deleted = true;
        $category->save();

        return response()->json([
            'success' => true
        ]);
    }
}
