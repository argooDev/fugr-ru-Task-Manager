<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskIndexRequest;
use App\Http\Requests\TaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Services\Service;
use OpenApi\Attributes as OA;


class TaskController extends Controller
{
    protected Service $service;
    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    #[OA\Get(
        path: '/api/tasks',
        summary: 'Get list of all tasks',
        tags: ['tasks'],
        parameters: [
            new OA\Parameter(
                name: 'search',
                in: 'query',
                description: 'Find by title',
                required: false,
                schema: new OA\Schema(type: 'string')
            ),
            new OA\Parameter(
                name: 'sort',
                in: 'query',
                description: 'Sort',
                required: false,
                schema: new OA\Schema(type: 'string', enum: ['deadline', 'created_at', 'id', 'title'])
            ),
            new OA\Parameter(
                name: 'per_page',
                in: 'query',
                description: 'Pagination',
                required: false,
                schema: new OA\Schema(type: 'integer', minimum: 1, maximum: 100)
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Get list of all tasks success',
                content: new OA\JsonContent(
                    type: 'object',
                    properties: [
                        new OA\Property(property: 'data', type: 'array', items: new OA\Items(ref: '#/components/schemas/TaskResource')),
                        new OA\Property(property: 'total', type: 'integer'),
                        new OA\Property(property: 'per_page', type: 'integer'),
                        new OA\Property(property: 'current_page', type: 'integer'),
                    ]    
                )
            )
        ]
    )]
    public function index(TaskIndexRequest $req)
    {
        $tasks = $this->service->index($req);
        return TaskResource::collection($tasks);
    }

    public function store(TaskRequest $req)
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

    public function update(Task $task, TaskRequest $req)
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