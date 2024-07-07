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

    /**
     * To ensure that the exception does not get caught by Laravel's exception handler
     * @return void
     */
    public function test_without_exception_handling()
    {
        $response = $this->withoutExceptionHandling()->get('/');
    }

    /**
     * When deprecation handling is disabled,
     * deprecation warnings will be converted to exceptions, thus causing your test to fail:
     * @throws \ErrorException
     */
    public function test_without_deprecation_handling()
    {
        $response = $this->withoutDeprecationHandling()->get('/');
    }
}
