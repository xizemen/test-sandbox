<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        return view('task-list', [
            'tasks' => []
        ]);
    }

    public function create()
    {

    }

    public function update()
    {

    }

    public function delete()
    {

    }
}
