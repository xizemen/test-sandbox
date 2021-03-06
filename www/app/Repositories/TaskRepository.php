<?php

namespace App\Repositories;

use App\Exceptions\NonExistentTaskException;
use App\Models\Task;
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
     * @param array $data
     * @return bool
     * @throws NonExistentTaskException
     */
    public function update(array $data): bool
    {
        $task = $this->get($data['id']);

        $task->task = $data['task'];
        $task->is_done = $data['is_done'];

        return $task->save();
    }

    /**
     * @param int $id
     * @return Builder|Model|object|null
     * @throws NonExistentTaskException
     */
    public function get(int $id)
    {
        $task = Task::query()
            ->where('is_deleted', 0)
            ->find($id);

        if (is_null($task)) {
            throw new NonExistentTaskException();
        }

        return $task;
    }

    /**
     * @param int $id
     * @return bool
     * @throws NonExistentTaskException
     */
    public function delete(int $id): bool
    {
        $task = $this->get($id);
        $task->is_deleted = 1;

        return $task->save();
    }
}
