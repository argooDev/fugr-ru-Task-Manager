<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index() {
        $search = request()->input('search');

        $sort = request()->input('sort', 'deadline');

        $tasks = Task::query()
            ->when($search, fn($query) => $query->where('title', 'like', "%{$search}%"))
            ->orderBy($sort, 'asc')
            ->paginate(10);
        
        return response()->json($tasks);
    }

    public function store() {
        $data = request()->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'deadline' => 'required|date',
            'status' => 'nullable|in:pending,completed',
            'priority' => 'nullable|in:low,medium,high',
            'category' => 'nullable|string|max:100',
        ]);

        $task = Task::create($data);

        return response()->json([
            'id' => $task->id,
            'message' => 'Task created successfully'
        ], 201);
    }

    public function show(Task $task) {
        return $task;
    }

    public function update(Task $task) {
        $data = request()->validate([
            'title' => 'sometimes|string|max:255',
            'description' => 'sometimes|nullable|string',
            'deadline' => 'sometimes|date',
            'status' => 'sometimes|in:pending,completed',
            'priority' => 'sometimes|in:low,medium,high',
            'category' => 'sometimes|nullable|string|max:100',
        ]);

        $task->update($data);

        return response()->json(['message' => "Task updated successfully"]);
    }

    public function destroy(Task $task) {
        $task->delete();
        return response()->json(['message' => 'Task deleted successfully']);
    }
}
