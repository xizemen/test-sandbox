<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Task List</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
        <link rel="stylesheet" href="{{url('/')}}/css/tasks.css">
        <script>const URL = '{{url('/')}}';</script>
    </head>
    <body>
        <div style="height: 100vh;">
            <div class="content h-100 pt-5 px-5 pb-0">
                <div class="jumbotron bg-light h-100 shadow-lg">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h1 class="display-4 mb-0">Task List</h1>
                        <button class="btn btn-success btn-lg init-create-task">Create a new task</button>
                    </div>
                    <p class="lead text-muted">Developed only for testing purposes.</p>
                    <table class="table mt-5" id="tasksTable">
                        <thead>
                        <tr>
                            <th scope="col">Task ID</th>
                            <th scope="col">Task</th>
                            <th scope="col">Status</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($tasks as $task)
                            <tr data-id="{{$task->id}}">
                                <th scope="row" class="task-id">{{$task->id}}</th>
                                <td class="w-50"><span class="task-name">{{$task->task}}</span></td>
                                <td>
                                    <span class="badge badge-{{$task->is_done ? 'success' : 'secondary'}} task-status text-uppercase">
                                        {{$task->is_done ? 'Done' : 'In progress'}}
                                    </span>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-warning mr-3 init-update-task">Update</button>
                                    <button type="button" class="btn btn-danger init-delete-task">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                        @include('/elements/layouts/noTasksYetRowLayout')
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        @include('/elements/layouts/createdTaskTableRowLayout')
        @include('/elements/modals/taskCreateModal')
        @include('/elements/modals/taskUpdateModal')
        @include('/elements/modals/taskDeleteModal')

        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js"></script>

        <script src="{{url('/')}}/js/index.js"></script>
    </body>
</html>
