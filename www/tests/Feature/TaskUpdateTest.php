<?php

namespace Tests\Feature;

use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class TaskUpdateTest extends TestCase
{
    private const MAX_TASK_NAME_LENGTH = 255;

    public function testTaskWithoutTaskDataUpdateFails()
    {
        $response = $this->json('POST', '/task', ['task' => 'Test task']);

        $response = $this->json('PUT', '/task/' . $response->json()['id']);

        $response->assertJson([
            'message' => 'The given data was invalid.',
            'errors' => [
                'task' => [
                    'A task must have a title!'
                ],
                'is_done' => [
                    "A task can be done or undone!"
                ]
            ]
        ])->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function testTaskWithLongTaskNameUpdateFails()
    {
        $response = $this->json('POST', '/task', ['task' => 'Test task']);

        $response = $this->json('PUT', '/task/' . $response->json()['id'], [
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

    public function testTaskWithWrongStatusUpdateFails()
    {
        $response = $this->json('POST', '/task', ['task' => 'Test task']);

        $response = $this->json('PUT', '/task/' . $response->json()['id'], [
            'task' => Str::random(),
            'is_done' => Str::random()
        ]);

        $response->assertJson([
            'message' => 'The given data was invalid.',
            'errors' => [
                'is_done' => [
                    'The is done field must be true or false.'
                ]
            ]
        ])->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function testTaskWithInvalidIdUpdateFails()
    {
        $response = $this->json('POST', '/task', ['task' => 'Test task']);
        $taskId = (int)$response->json()['id'] + rand(1, (int)$response->json()['id']);

        $response = $this->json('PUT', '/task/' . $taskId, [
            'task' => 'This is a different task name!', 'is_done' => 1
        ]);

        $response->assertJson([
            'message' => 'The given data was invalid.',
            'errors' => [
                'id' => [
                    'The selected id is invalid.'
                ]
            ]
        ])->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function testXssStrippedTaskIsUpdated()
    {
        $response = $this->json('POST', '/task', ['task' => 'Test task']);

        $response = $this->json('PUT', '/task/' . $response->json()['id'], [
            'task' => '<script>const data = "This is a different task name!"; console.log(data);</script>',
            'is_done' => 1
        ]);

        $response->assertJson([
            'task' => 'const data = "This is a different task name!"; console.log(data);',
            'is_done' => 1
        ])->assertStatus(Response::HTTP_OK);
    }

    public function testValidTaskIsUpdated()
    {
        $response = $this->json('POST', '/task', ['task' => 'Test task']);

        $response = $this->json('PUT', '/task/' . $response->json()['id'], [
            'task' => 'This is a different task name!', 'is_done' => 1
        ]);

        $response
            ->assertJson(['task' => 'This is a different task name!', 'is_done' => 1])
            ->assertStatus(Response::HTTP_OK);
    }
}
