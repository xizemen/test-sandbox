<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\DeleteTaskRequest;
use App\Http\Requests\GetTaskRequest;
use App\Http\Requests\UpdateTaskRequest;

class TaskController extends Controller
{
    public function index(GetTaskRequest $request)
    {
        $validated = $request->validated();

        return view('task-list', [
            'tasks' => []
        ]);
    }

    public function create(CreateTaskRequest $request)
    {
        $validated = $request->validated();
    }

    public function update(UpdateTaskRequest $request)
    {
        $validated = $request->validated();
    }

    public function delete(DeleteTaskRequest $request)
    {
        $validated = $request->validated();
    }
}
