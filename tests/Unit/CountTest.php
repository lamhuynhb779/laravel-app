<?php

use PHPUnit\Framework\TestCase;

class CountTest extends TestCase
{
    public function testCount(): void
    {
        $count = count([1,2,3,4,5]);

        $this->assertSame($count, 5);
    }
}
