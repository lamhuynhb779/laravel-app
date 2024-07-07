<?php

namespace Tests\Feature;

use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class ExampleJSONTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_making_an_api_request()
    {
        $response = $this->postJson('/api/login', [
            "email" => "test@gmail.com",
            "password" => "123456789"
        ]);

        $response
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    'id' => 1,
                ]
            ])
            ->assertJson(['data' => ['name' => 'test']])
            ->assertJsonPath('data.id', 1);
//            ->assertJsonPath('data.id', function ($id) {
//                return $id > 0;
//            });
//            ->assertExactJson([
//                'data' => [
//                    'id' => 1,
//                ]
//            ]);
    }

    public function test_fluent_json()
    {
        $response = $this->getJson('/api/public/articles/1');

        $response->assertStatus(200)
            ->assertJson(function (AssertableJson $json) {
                $json->where('id', 1)
                    ->whereContains('title', 'article name')
                    ->etc(); // v.v... thong bao voi laravel rang  co the co nhung field khac thuoc json
            });
    }
}
