<?php

namespace App\Services;

use App\Exceptions\NonExistentTaskException;
use App\Repositories\TaskRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Class TaskService
 * @package App\Services
 */
class TaskService
{
    /**
     * @var TaskRepository
     */
    protected $taskRepository;

    /**
     * TaskService constructor.
     * @param TaskRepository $taskRepository
     */
    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->taskRepository->getAll();
    }

    /**
     * @param int $id
     * @return Builder|Model|object|null
     * @throws NonExistentTaskException
     */
    public function get(int $id)
    {
        return $this->taskRepository->get($id);
    }

    /**
     * @param array $data
     * @return int
     */
    public function create(array $data): int
    {
        return $this->taskRepository->create($data);
    }

    /**
     * @param array $data
     * @return Builder|Model|Collection|object
     * @throws NonExistentTaskException
     */
    public function update(array $data): bool
    {
        return $this->taskRepository->update($data);
    }

    /**
     * @param int $id
     * @return bool
     * @throws NonExistentTaskException
     */
    public function delete(int $id): bool
    {
        return $this->taskRepository->delete($id);
    }
}
