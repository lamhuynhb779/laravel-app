<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

/**
 * Class de dinh nghia cac ham common dung chung cho toan bo cac test case
 */
abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
}
