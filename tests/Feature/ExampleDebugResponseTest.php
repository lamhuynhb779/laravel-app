<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ExampleDebugResponseTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_basic_debug_http_response()
    {
        $response = $this->get('/');

        $response->dumpHeaders();
        $response->dumpSession();
        $response->assertStatus(200);

        // dump va dung chay
//        $response->ddHeaders();
//        $response->ddSession();
//        $response->dd();
    }

    public function test_occur_exception_without_caught()
    {
        $response = $this->withoutExceptionHandling()->get('/');
    }
}
