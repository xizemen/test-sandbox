<?php

namespace Tests\Feature;

use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class ErrorPageTest extends TestCase
{
    public function test404ErrorPageIsRendered()
    {
        $response = $this->get('/' . Str::random());

        $response
            ->assertViewIs('error404')
            ->assertSee('Page not found | 404')
            ->assertStatus(Response::HTTP_OK);
    }
}
