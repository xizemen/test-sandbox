<?php

namespace App\Services;

use App\Repositories\TaskRepository;

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
     * @return array
     */
    public function getAll(): array
    {
        $this->taskRepository->getAll();
    }

    /**
     * @param int $id
     * @return array
     */
    public function get(int $id): array
    {
        return $this->taskRepository->get($id);
    }

    /**
     * @param array $data
     * @return bool
     */
    public function create(array $data): bool
    {
        return $this->taskRepository->create($data);
    }

    /**
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update(int $id, array $data): bool
    {
        return $this->taskRepository->update($id, $data);
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        return $this->taskRepository->delete($id);
    }
}
