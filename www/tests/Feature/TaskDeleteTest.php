<?php

namespace Tests\Feature;

use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class TaskDeleteTest extends TestCase
{
    public function testDeleteWithInvalidIdFails()
    {
        $response = $this->json('POST', '/task', ['task' => 'Test task']);
        $taskId = (int)$response->json()['id'] + rand(1, (int)$response->json()['id']);

        $response = $this->json('DELETE', '/task/' . $taskId);

        $response->assertJson([
            'message' => 'The given data was invalid.',
            'errors' => [
                'id' => [
                    'The selected id is invalid.'
                ]
            ]
        ])->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function testValidTaskIsDeleted()
    {
        $response = $this->json('POST', '/task', ['task' => 'Test task']);

        $response = $this->json('DELETE', '/task/' . $response->json()['id']);

        $this->assertTrue($response->json());

        $response->assertStatus(Response::HTTP_OK);
    }
}
