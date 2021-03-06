<?php

namespace App\Http\Controllers;

use App\Exceptions\NonExistentTaskException;
use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\DeleteTaskRequest;
use App\Http\Requests\GetTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Services\TaskService;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

/**
 * Class TaskController
 * @package App\Http\Controllers
 */
class TaskController extends Controller
{
    /**
     * @var TaskService
     */
    protected $taskService;

    /**
     * TaskController constructor.
     * @param TaskService $taskService
     */
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
     * @throws NonExistentTaskException
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
     * @throws NonExistentTaskException
     */
    public function create(CreateTaskRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $id = $this->taskService->create($validated);
        $task = $this->taskService->get($id);

        return response()->json($task);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateTaskRequest $request
     * @return JsonResponse
     * @throws NonExistentTaskException
     */
    public function update(UpdateTaskRequest $request): JsonResponse
    {
        $validatedData = $request->validated();

        $this->taskService->update($validatedData);
        $task = $this->taskService->get($validatedData['id']);

        return response()->json($task);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DeleteTaskRequest $request
     * @return JsonResponse
     * @throws NonExistentTaskException
     */
    public function destroy(DeleteTaskRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $isDeleted = $this->taskService->delete($validated['id']);

        return response()->json($isDeleted);
    }
}
