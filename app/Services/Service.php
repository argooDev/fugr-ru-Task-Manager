<?php

namespace App\Services;

use App\Http\Requests\TaskIndexRequest;
use App\Models\Task;

class Service {

    public function index(TaskIndexRequest $req){
        $search = $req->input('search');
        $sort = $req->input('sort', 'deadline');
        $per_page = $req->input('per_page', 10);

        return Task::query()
            ->when($search, fn($query) => $query->where('title', 'like', "%{$search}%"))
            ->orderBy($sort, 'asc')
            ->paginate($per_page);
    }

    public function store(array $data): Task {
        return Task::create($data);
    }

    public function update(Task $task, array $data) {
        return $task->update($data);
    }


    public function delete(Task $task) {
        $task->delete();
    }

}