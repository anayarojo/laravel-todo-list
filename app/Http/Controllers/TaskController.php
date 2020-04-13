<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Task;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Group|null $list
     * @return \Illuminate\Http\Response
     */
    public function index(Group $list = null)
    {
        $tasks = $list && $list->id ? $list->tasks : JWTAuth::user()->lists;

        return response()->json([
            'success' => true,
            'data' => $tasks
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Group|null $list
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Group $list = null)
    {
        $task = $list && $list->id ? $list->tasks()->create($request->all()) : JWTAuth::user()->tasks()->create($request->all());

        return response()->json([
            'success' => true,
            'data' => $task
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        return response()->json([
            'success' => true,
            'data' => $task
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Task $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $task->update($request->all());

        return response()->json([
            'success' => true,
            'data' => $task
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->deleted = true;
        $task->save();

        return response()->json([
            'success' => true
        ]);
    }
}
