<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class VoucherTest extends TestCase
{

    protected function setUp(): void
    {
        parent::setUp();

        // Do your things
        dump(1);
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->assertTrue(true);
        dump(2);
    }

    protected function tearDown(): void
    {
        // Do your things
        dump(3);

        parent::tearDown();
    }
}
