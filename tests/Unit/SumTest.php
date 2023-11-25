<?php

function sum(int $a, int $b): int
{
    return $a + $b;
}

test('sum', function () {
    $result = sum(1, 2);

    // Expectation API
    expect($result)->toBe(3);
});

it('performs sums', function () {
    $result = sum(1, 2);

    // Expectation API
    expect($result)
        ->toBeInt()
        ->toBe(3)
        ->not->toBeString()
        ->not->toBe(4);
});

it('performs complex test', function () {
    expect([1,2,3])->sequence(
        function ($number) { $number->toBe(1);},
        function ($number) { $number->toBe(2);},
        function ($number) { $number->toBe(3);}
    );

    // Test cases
    $config = ['env' => 'production', 'auto_deploy' => true];
    expect($config)->unless($config['env'] === 'test', function (\Pest\Expectation $config) {
        $value = $config->value;
        // condition => sai. Thi moi thuc hien trong day
        expect($value['auto_deploy'])->toBeTrue();
    });
});
