<?php

namespace App\Repositories;

use App\Models\Task;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
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
     * @return Collection
     */
    public function getAll(): Collection
    {
        return Task::query()
            ->where('is_deleted', 0)
            ->latest('created_at')
            ->get();
    }

    /**
     * @param int $id
     * @return Builder|Model|object|null
     */
    public function get(int $id)
    {
        return Task::query()
            ->where('id', $id)
            ->where('is_deleted', 0)
            ->first();
    }

    /**
     * @param array $data
     * @return int
     */
    public function create(array $data): int
    {
        $task = new Task;

        $task->task = $data['task'];
        $task->save();

        return $task->id;
    }

    /**
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update(int $id, array $data): bool
    {
        $task = Task::query()->where('is_deleted', 0)->find($id);

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
            $task = Task::query()->where('is_deleted', 0)->find($id);
            $task->is_deleted = 1;

            $task->save();
            return true;
        } catch (Exception $e) {
        }

        return false;
    }
}
