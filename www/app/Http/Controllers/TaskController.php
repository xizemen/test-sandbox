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
        return view('task-list', [
            'tasks' => []
        ]);
    }

    public function create(CreateTaskRequest $request)
    {

    }

    public function update(UpdateTaskRequest $request)
    {

    }

    public function delete(DeleteTaskRequest $request)
    {

    }
}
