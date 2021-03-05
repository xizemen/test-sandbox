<?php

namespace App\Repositories;

use App\Models\Task;
use Exception;
use Illuminate\Support\Collection;

/**
 * Class TaskRepository
 * @package App\Repositories
 */
class TaskRepository
{
    /**
     * @var Task
     */
    protected $task;

    /**
     * TaskRepository constructor.
     * @param Task $task
     */
    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        return Task::query()
            ->where('deleted_at')
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * @param int $id
     * @return array
     */
    public function get(int $id): array
    {
        return Task::query()
            ->where('id', $id)
            ->where('deleted_at')
            ->limit(1)
            ->get();
    }

    /**
     * @param array $data
     * @return bool
     */
    public function create(array $data): bool
    {
        $task = new Task;

        $task->task = $data['task'];
        $task->is_done = $data['is_done'];

        return $task->save();
    }

    /**
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update(int $id, array $data): bool
    {
        $task = Task::query()->find($id);

        $task->task = $data['task'];
        $task->is_done = $data['is_done'];

        return $task->save();
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        try {
            return Task::query()->find($id)->delete();
        } catch (Exception $e) {
        }

        return false;
    }
}
