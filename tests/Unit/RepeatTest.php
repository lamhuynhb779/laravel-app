<?php

it('can repeat a test', function () {

    $result = 3 > 2; /** Some code that may be unstable */

    expect($result)->toBeTrue();

})->repeat(10); // Repeat 10 times
