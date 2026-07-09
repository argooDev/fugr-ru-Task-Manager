<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskIndexRequest;
use App\Http\Requests\TaskStoreRequest;
use App\Http\Requests\TaskUpdateRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Services\Service;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    protected Service $service;
    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    public function index(TaskIndexRequest $req)
    {
        $tasks = $this->service->index($req);
        return TaskResource::collection($tasks);
    }

    public function store(TaskStoreRequest $req)
    {
        $task = $this->service->store($req->validated());

        return response()->json([
            'id' => $task->id,
            'message' => 'Task created successfully'
        ], 201);
    }

    public function show(Task $task)
    {
        return new TaskResource($task);
    }

    public function update(Task $task, TaskUpdateRequest $req)
    {
        $this->service->update($task, $req->validated());

        return response()->json(['message' => "Task updated successfully"]);
    }

    public function destroy(Task $task)
    {
        $this->service->delete($task);
        return response()->json(['message' => 'Task deleted successfully']);
    }
}