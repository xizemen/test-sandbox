<?php

namespace Tests\Feature;

use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class TaskIndexTest extends TestCase
{
    public function testTaskIndexPageIsLoaded()
    {
        $response = $this->get('/');

        $response
            ->assertViewIs('tasks')
            ->assertSee('Task List')
            ->assertStatus(Response::HTTP_OK);

        $response = $this->get('/task');

        $response
            ->assertViewIs('tasks')
            ->assertSee('Task List')
            ->assertStatus(Response::HTTP_OK);
    }
}
