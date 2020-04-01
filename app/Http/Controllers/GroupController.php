<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Group|null $parent
     * @return \Illuminate\Http\Response
     */
    public function index(Group $parent = null)
    {
        $groups = $parent ?
            $parent->children :
            JWTAuth::user()->groups;

        return response()->json([
            'success' => true,
            'data' => $groups
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Group|null $parent
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Group $parent = null)
    {
        $group = $parent != null ?
            $parent->children()->create($request->all()) :
            JWTAuth::user()->groups()->create($request->all());

        return response()->json([
            'success' => true,
            'data' => $group
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group)
    {
        return response()->json([
            'success' => true,
            'data' => $group
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Group $group
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Group $group)
    {
        $group->update($request->all());

        return response()->json([
            'success' => true,
            'data' => $group
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group)
    {
        $group->deleted = true;
        $group->save();

        return response()->json([
            'success' => true
        ]);
    }
}
