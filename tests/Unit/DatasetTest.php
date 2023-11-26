<?php

use App\Models\User;

it('has emails (style 1)', function (string $email) {
    expect($email)->not->toBeEmpty();
})->with(['abc@gmail.com', 'def@gmail.com']);

it('has emails (style 2)', function (string $name, string $email) {
    expect($email)->not->toBeEmpty();
})->with([
    ['abc', 'abc@gmail.com'],
    ['def', 'def@gmail.com']
]);

it('has emails (style 3)', function (string $email) {
    expect($email)
        ->not->toBeEmpty()
        ->toEndWith('gmail.com');
})->with([
    'abc' => 'abc@gmail.com',
    'def' => 'def@gmail.com'
]);

it('can sum', function (int $a, int $b, int $result) {
    expect($a + $b)->toBe($result);
})->with([
    'positive numbers' => [1,2,3],
    'negative number' => [-1,-2,-3],
//    'using closure' => function() { return [1,2,3]; }
]);

//it('can generate the full name of a user', function (User $user) {
//    expect($user->email)->toContain($user->name);
//})->with([
//    function() {User::factory()->create(['name' => 'maduro', 'email' => 'maduro@gmail.com']);},
//    function() {User::factory()->create(['name' => 'downing', 'email' => 'downinggmail.com']);},
//    function() {User::factory()->create(['name' => 'van', 'email' => 'vanderhertengmail.com']);},
//]);

// Sharing Datasets
it('test dataset emails in file Emails.php', function (string $email) {
    expect($email)->not->toBeEmpty();
})->with('emails');
