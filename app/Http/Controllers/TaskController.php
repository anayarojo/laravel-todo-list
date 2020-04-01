<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Group|null $group
     * @return \Illuminate\Http\Response
     */
    public function index(Group $group)
    {
        $tasks = $group->tasks;

        return response()->json([
            'success' => true,
            'data' => $tasks
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Group $group
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Group $group)
    {
        $task = $group->tasks()->create($request->all());

        return response()->json([
            'success' => true,
            'data' => $task
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param Group $group
     * @param  \App\Models\Task $task
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group, Task $task)
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
     * @param Group $group
     * @param  \App\Models\Task $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Group $group, Task $task)
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
     * @param Group $group
     * @param  \App\Models\Task $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group, Task $task)
    {
        $task->deleted = true;
        $task->save();

        return response()->json([
            'success' => true
        ]);
    }
}
