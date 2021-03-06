<?php

namespace Tests\Feature;

use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class TaskCreateTest extends TestCase
{
    private const MAX_TASK_NAME_LENGTH = 255;

    public function testTaskWithoutTaskTitleCreateFails()
    {
        $response = $this->json('POST', '/task');

        $response->assertJson([
            'message' => 'The given data was invalid.',
            'errors' => [
                'task' => [
                    'A task must have a title!'
                ]
            ]
        ])->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function testTaskWithLongTaskNameCreateFails()
    {
        $response = $this->json('POST', '/task', [
            'task' => Str::random(self::MAX_TASK_NAME_LENGTH + rand(1, self::MAX_TASK_NAME_LENGTH))
        ]);

        $response->assertJson([
            'message' => 'The given data was invalid.',
            'errors' => [
                'task' => [
                    'The task may not be greater than 255 characters.'
                ]
            ]
        ])->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function testValidTaskIsCreated()
    {
        $response = $this->json('POST', '/task', [
            'task' => 'Test task'
        ]);

        $response
            ->assertJson(['task' => 'Test task', 'is_done' => 0])
            ->assertStatus(Response::HTTP_OK);
    }
}
