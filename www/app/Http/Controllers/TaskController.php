<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\DeleteTaskRequest;
use App\Http\Requests\GetTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Services\TaskService;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class TaskController extends Controller
{
    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        return view('tasks', [
            'tasks' => $this->taskService->getAll()
        ]);
    }

    /**
     * Get the specified resource.
     *
     * @param GetTaskRequest $request
     * @return JsonResponse
     */
    public function get(GetTaskRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $task = $this->taskService->get($validated['id']);

        return response()->json($task);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param CreateTaskRequest $request
     * @return JsonResponse
     */
    public function create(CreateTaskRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $task = $this->taskService->create($validated);

        return response()->json($task);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateTaskRequest $request
     * @return JsonResponse
     */
    public function update(UpdateTaskRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $task = $this->taskService->update($validated['id'], $validated);

        return response()->json($task);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DeleteTaskRequest $request
     * @return JsonResponse
     */
    public function destroy(DeleteTaskRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $task = $this->taskService->delete($validated['id']);

        return response()->json($task);
    }
}
