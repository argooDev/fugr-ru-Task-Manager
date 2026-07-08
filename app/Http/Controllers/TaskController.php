<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index() {
        $search = request()->input('search');

        $tasks = Task::query()
            ->when($search, fn($query) => $query->where('title', 'like', "%{$search}%"))
            ->paginate(5);
        
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

        return response()->json($task, 201);
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

        return response()->json($task->update($data));
    }

    public function destroy(Task $task) {
        return response()->json($task->delete());
    }
}
